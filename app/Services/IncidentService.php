<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IncidentService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.incidents.base_url'), '/') . '/';
    }

    public function getIncidents(int $minutes = 60): array
    {
        $apiKey = config('services.incidents.api_key');

        if (!$apiKey) {
            return [];
        }

        $response = Http::timeout(10)
            ->withToken($apiKey)
            ->get($this->baseUrl . 'incidents-read', [
                'minutes' => $minutes,
            ]);

        if ($response->failed()) {
            return [];
        }

        $data = $response->json();
        return is_array($data['incidents'] ?? null) ? $data['incidents'] : [];
    }
}
