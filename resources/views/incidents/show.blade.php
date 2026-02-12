@extends('layouts.app')

@section('title', 'Incident Details')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $incident->title }}</h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('incidents.edit', $incident) }}" class="text-blue-600 hover:underline">Bewerken</a>
            <a href="{{ route('incidents.index') }}" class="text-blue-600 hover:underline">&larr; Terug naar overzicht</a>
        </div>
    </div>

    <div class="space-y-4 text-gray-700">
        <p><strong>Omschrijving:</strong> {{ $incident->description }}</p>
        <p><strong>Locatie:</strong> {{ $incident->location }}</p>
        <p><strong>Type:</strong> {{ $incident->type }}</p>
        <p><strong>Datum:</strong> {{ optional($incident->incident_at)->format('d-m-Y H:i') }}</p>
        <p><strong>Status:</strong> {{ str_replace('_', ' ', $incident->status ?? 'nieuw') }}</p>
        <p><strong>Prioriteit:</strong> {{ $incident->priority ?? 'normaal' }}</p>

        @if($incident->attachment)
            <p>
                <strong>Bijlage:</strong>
                <a href="{{ asset('storage/' . $incident->attachment) }}" class="text-blue-600 hover:underline" target="_blank">
                    Bekijk bestand
                </a>
            </p>
        @endif
    </div>
</div>
@endsection
