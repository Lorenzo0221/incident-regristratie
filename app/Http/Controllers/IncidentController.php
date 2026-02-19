<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::latest()->get();

        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }
    public function show(Incident $incident)
    {
        return view('incidents.show', compact('incident'));
    }

    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
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
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->store('attachments', 'public');
        }

        Incident::create($data);

        return redirect()->route('incidents.index');
    }

    public function update(Request $request, Incident $incident)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'incident_at' => 'required|date',
            'status' => 'required|in:nieuw,in_behandeling,wachten,opgelost,gesloten',
            'priority' => 'required|in:laag,normaal,hoog,urgent',
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

        return redirect()->route('incidents.show', $incident);
    }
}
