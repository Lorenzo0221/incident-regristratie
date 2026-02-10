<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::where('user_id', Auth::id())->get();
        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'incident_at' => 'required|date',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $data['user_id'] = Auth::id();

        Incident::create($data);

        return redirect()->route('incidents.index');
    }
}
