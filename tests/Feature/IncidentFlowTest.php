<?php

use App\Models\Incident;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create an incident', function () {
    $response = $this->post(route('incidents.store'), [
        'title' => 'Stroomuitval',
        'description' => 'Er is een storing gemeld.',
        'location' => 'Gebouw A',
        'type' => 'ongeval',
        'incident_at' => '2026-02-10T10:30',
        'status' => 'nieuw',
        'priority' => 'hoog',
    ]);

    $response->assertRedirect(route('incidents.index'));

    $this->assertDatabaseHas('incidents', [
        'title' => 'Stroomuitval',
        'status' => 'nieuw',
        'priority' => 'hoog',
    ]);
});

it('blocks direct status transition from nieuw to gesloten', function () {
    $incident = Incident::create([
        'title' => 'Test melding',
        'description' => 'Beschrijving',
        'location' => 'Locatie',
        'type' => 'geweld',
        'incident_at' => '2026-02-10 10:30:00',
        'status' => 'nieuw',
        'priority' => 'normaal',
    ]);

    $response = $this->from(route('incidents.edit', $incident))
        ->put(route('incidents.update', $incident), [
            'title' => $incident->title,
            'description' => $incident->description,
            'location' => $incident->location,
            'type' => $incident->type,
            'incident_at' => '2026-02-10T10:30',
            'status' => 'gesloten',
            'priority' => $incident->priority,
        ]);

    $response->assertRedirect(route('incidents.edit', $incident));
    $response->assertSessionHasErrors('status');
});
