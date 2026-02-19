<x-base-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Incident statistieken</h1>
        <a href="{{ route('incidents.index') }}" class="border border-gray-300 px-4 py-2 rounded hover:bg-gray-50">
            Terug naar meldingen
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Incidenten per type</h2>
            @if ($statsByType->isEmpty())
                <div class="text-sm text-gray-500">Geen data beschikbaar.</div>
            @else
                <ul class="space-y-1 text-sm">
                    @foreach ($statsByType as $row)
                        <li class="flex justify-between">
                            <span>{{ $row->type }}</span>
                            <span class="font-medium">{{ $row->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Incidenten per periode</h2>
            @if ($statsByPeriod->isEmpty())
                <div class="text-sm text-gray-500">Geen data beschikbaar.</div>
            @else
                <ul class="space-y-1 text-sm">
                    @foreach ($statsByPeriod as $row)
                        <li class="flex justify-between">
                            <span>{{ $row->period }}</span>
                            <span class="font-medium">{{ $row->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Incidenten per locatie</h2>
            @if ($statsByLocation->isEmpty())
                <div class="text-sm text-gray-500">Geen data beschikbaar.</div>
            @else
                <ul class="space-y-1 text-sm">
                    @foreach ($statsByLocation as $row)
                        <li class="flex justify-between">
                            <span>{{ $row->location }}</span>
                            <span class="font-medium">{{ $row->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-base-layout>
