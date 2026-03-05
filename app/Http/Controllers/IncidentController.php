<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\User;
use App\Notifications\IncidentStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\IncidentCreated;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreIncidentRequest;


class IncidentController extends Controller
{
    public function exportPdf(Request $request)
    {
        $query = Incident::query();

        // Zelfde filters als index
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('incident_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('incident_at', '<=', $request->date_to);
        }

        $incidents = $query->latest()->get();

        $pdf = Pdf::loadView('incidents.export-pdf', compact('incidents'));
        return $pdf->download('incidenten.pdf');
    }

    public function index()
    {

        $query = Incident::query();

        // Filter op locatie
        if (request()->filled('location')) {
            $query->where('location', 'like', '%' . request('location') . '%');
        }

        // Filter op status
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        // Filter op datum (incident_at)
        if (request()->filled('date_from')) {
            $query->whereDate('incident_at', '>=', request('date_from'));
        }
        if (request()->filled('date_to')) {
            $query->whereDate('incident_at', '<=', request('date_to'));
        }

        $incidents = $query->latest()->get();

        return view('incidents.index', compact('incidents'));
    }

    public function stats()
    {
        $locations = Location::all();
        return view('incidents.create', compact('locations'));
    }

    public function store(StoreIncidentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('incidents', 'public');
        }

        $incident = Incident::create($data);

        // E-mail sturen naar coördinator
        Mail::to('coordinator@example.com')->send(new IncidentCreated($incident));

        // Redirect naar incidenten overzicht zodat $incidents altijd beschikbaar is
        return redirect()->route('incidents.index')->with('success', 'Incident aangemaakt en coördinator geïnformeerd.');
    }

    public function update(Request $request, Incident $incident)
    {
        $oldStatus = $incident->status;

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'incident_at' => 'required|date',
            'status' => 'required|in:nieuw,in_behandeling,wachten,opgelost,gesloten',
            'priority' => 'required|in:laag,normaal,hoog,urgent',
            'assignee_id' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($incident->status === 'nieuw' && $data['status'] === 'gesloten') {
            return back()
                ->withErrors(['status' => 'Status mag niet direct van nieuw naar gesloten.'])
                ->withInput();
        }

        $incident->update($data);
        [
            'type' => 'required|string',
            'incident_at' => 'nullable|date',
            'attachment' => 'nullable|file|max:10240',
        ];


        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->store('attachments', 'public');
        } else {
            unset($data['attachment']);
        }

        $incident->update($data);

        $incident->refresh();

        if ($oldStatus !== $incident->status) {
            $recipient = $incident->user;
            if ($recipient) {
                $recipient->notify(new IncidentStatusChanged($incident, $oldStatus, $incident->status));
            }

            $actor = $request->user();
            if ($actor && (!$recipient || $actor->id !== $recipient->id)) {
                $actor->notify(new IncidentStatusChanged($incident, $oldStatus, $incident->status));
            }
        }

        return redirect()->route('incidents.show', $incident);
    }
}
