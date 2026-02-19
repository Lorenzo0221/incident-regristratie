<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\User;
use App\Notifications\IncidentStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::latest()->get();

        return view('incidents.index', compact('incidents'));
    }

    public function stats()
    {
        $statsByType = Incident::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();

        $statsByLocation = Incident::select('location', DB::raw('count(*) as total'))
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->groupBy('location')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $statsByPeriod = Incident::selectRaw("DATE_FORMAT(incident_at, '%Y-%m') as period, count(*) as total")
            ->whereNotNull('incident_at')
            ->groupBy('period')
            ->orderBy('period', 'desc')
            ->limit(12)
            ->get();

        return view('incidents.stats', compact('statsByType', 'statsByLocation', 'statsByPeriod'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get(['id', 'name']);

        return view('incidents.create', compact('users'));
    }
    public function show(Incident $incident)
    {
        return view('incidents.show', compact('incident'));
    }

    public function edit(Incident $incident)
    {
        $users = User::orderBy('name')->get(['id', 'name']);

        return view('incidents.edit', compact('incident', 'users'));
    }

    public function store(Request $request)
    {
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

        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->store('attachments', 'public');
        }

        Incident::create($data);

        return redirect()->route('incidents.index');
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
