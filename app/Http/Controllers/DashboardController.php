<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $incidents = Incident::latest()->get();

        // Statistiek: aantal incidenten per locatie
        $perLocation = Incident::select('location')
            ->selectRaw('count(*) as total')
            ->groupBy('location')
            ->orderByDesc('total')
            ->get();

        // Statistiek: aantal incidenten per maand
        $perMonth = Incident::selectRaw('DATE_FORMAT(incident_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard.index', compact('incidents', 'perLocation', 'perMonth'));
    }
}
