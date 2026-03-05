<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        // Logica om een lijst van locaties op te halen en weer te geven
        return view('location.index', compact('locations'));
    }

    public function create()
    {
        // Logica om een formulier weer te geven voor het aanmaken van een nieuwe locatie
    }

    public function store(Request $request)
    {
        // Logica om een nieuwe locatie op te slaan in de database
    }

    public function show($id)
    {
        // Logica om een specifieke locatie weer te geven
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('location.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $location->update($validated);
        return redirect()->route('locations.index')->with('success', 'Locatie bijgewerkt.');
    }

    public function destroy($id)
    {
        // Logica om een locatie te verwijderen uit de database
    }
}
