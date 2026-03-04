<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Models\Incident;
use Illuminate\Http\Request;
use App\Notifications\NewIncidentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\IncidentCreated;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use App\Models\Location;

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

        $pdf = FacadePdf::loadView('incidents.export-pdf', compact('incidents'));
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

    public function create()
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

    public function show(Incident $incident)
    {
        return view('incidents.show', compact('incident'));
    }

    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
    }

    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('incidents', 'public');
        }

        $incident->update($data);
        [
            'type' => 'required|string',
            'incident_at' => 'nullable|date',
            'attachment' => 'nullable|file|max:10240',
        ];


        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('incidents', 'public');
        }

        $incident->update($data);

        return redirect()
            ->route('incidents.show', $incident)
            ->with('success', 'Incident succesvol bijgewerkt.');
    }
}
