<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function create()
    {

        return view('types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:type,name',
        ]);

        Type::create($validated);

        return redirect()->route('types.index')->with('success', 'Type toegevoegd.');
    }

    public function edit($id)
    {
        $types = Type::findOrFail($id);
        return view('types.edit', compact('types'));
    }

    public function update(Request $request, $id)
    {
        $types = Type::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $types->id,
        ]);

        $types->update($validated);

        return redirect()->route('types.index')->with('success', 'Type bijgewerkt.');
    }

    public function destroy($id)
    {
        $types = Type::findOrFail($id);
        $types->delete();

        return redirect()->route('types.index')->with('success', 'Type verwijderd.');
    }
}
