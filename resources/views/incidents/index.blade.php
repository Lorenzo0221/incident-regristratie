@extends('layouts.app')

@section('title', 'Mijn meldingen')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Mijn meldingen</h1>

        <a href="{{ route('incidents.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nieuwe melding
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($incidents as $incident)
            <div class="p-4">
                <h2 class="text-lg font-semibold">{{ $incident->title }}</h2>

                <p class="text-sm text-gray-600 mt-1">
                    📍 {{ $incident->location ?? 'Onbekend' }}
                </p>

                <p class="text-sm text-gray-500">
                    📅 {{ $incident->incident_at }}
                </p>

                @isset($incident->status)
                    <p class="text-sm mt-2">
                        Status:
                        <span class="font-medium">{{ $incident->status }}</span>
                    </p>
                @endisset
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">
                Nog geen meldingen.
            </div>
        @endforelse
    </div>
@endsection
