<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
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

    public function store(StoreIncidentRequest $StoreIncidentRequest)
    {
        $data = $StoreIncidentRequest->validated();

        if ($StoreIncidentRequest->hasFile('attachment')) {
            $data['attachment'] = $StoreIncidentRequest->file('attachment')
                ->store('attachments', 'public');
        }

        Incident::create($data);

        return redirect()->route('incidents.index');
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
            ['type' => 'required|string',
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
