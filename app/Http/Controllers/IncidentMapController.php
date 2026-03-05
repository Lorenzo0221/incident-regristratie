<?php

namespace App\Http\Controllers;

use App\Models\MapIncident;
use App\Services\IncidentService;
use Carbon\Carbon;

class IncidentMapController extends Controller
{
    

    public function index()
    {
        $cacheMinutes = 10;

        $latestIncident = MapIncident::orderBy('fetched_at', 'desc')->first();
        $dataIsExpired = !$latestIncident || $latestIncident->fetched_at < Carbon::now()->subMinutes($cacheMinutes);

        if ($dataIsExpired) {
            $this->syncIncidents();
            $fromCache = false;
        } else {
            $fromCache = true;
        }

        $incidents = MapIncident::orderBy('fetched_at', 'desc')->get();

        return view('map.index', compact('incidents', 'fromCache'));
    }

    public function refresh()
    {
        $this->syncIncidents();

        return redirect()->route('incidents.map.index');
    }

    private function syncIncidents(int $minutes = 60): void
    {
        $service = new IncidentService();
        $apiIncidents = $service->getIncidents($minutes);

        foreach ($apiIncidents as $apiIncident) {
            if (!isset($apiIncident['id'])) {
                continue;
            }

            MapIncident::updateOrCreate(
                ['api_id' => $apiIncident['id']],
                [
                    'service' => $apiIncident['service'] ?? 'unknown',
                    'place' => $apiIncident['place'] ?? '',
                    'street' => $apiIncident['street'] ?? '',
                    'description' => $apiIncident['description'] ?? '',
                    'latitude' => (float) ($apiIncident['latitude'] ?? 0),
                    'longitude' => (float) ($apiIncident['longitude'] ?? 0),
                    'fetched_at' => now(),
                ]
            );
        }
    }
}
