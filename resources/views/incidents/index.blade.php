<x-base-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Mijn meldingen</h1>

        <a href="{{ route('incidents.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nieuwe melding
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($incidents as $incident)
        <div class="p-4 flex justify-between items-start">

            <div>
                <h2 class="text-lg font-semibold">{{ $incident->title }}</h2>

                <p class="text-sm text-gray-600 mt-1">
                    📍 {{ $incident->location ?? 'Onbekend' }}
                </p>

                <p class="text-sm text-gray-500">
                    📅 {{ \Carbon\Carbon::parse($incident->incident_at)->format('d M Y H:i') }}
                </p>

                @isset($incident->status)
                <p class="text-sm mt-2">
                    Status:
                    <span class="font-medium">{{ $incident->status }}</span>
                </p>
                @endisset
            </div>

            {{-- Acties --}}
             <div class="flex flex-col gap-2">
                <a href="{{ route('incidents.show', $incident) }}"
                    class="inline-flex items-center justify-center
                      px-4 py-2 rounded-lg
                      bg-blue-600 text-white text-sm font-medium
                      hover:bg-blue-700 transition">
                    👁️ Details
                </a>

                <a href="{{ route('incidents.edit', $incident) }}"
                    class="inline-flex items-center justify-center
                      px-4 py-2 rounded-lg
                      bg-gray-600 text-white text-sm font-medium
                      hover:bg-gray-700 transition">
                    ✏️ Bewerken
                </a>
            </div>
        </div>
        @empty

        <div class="p-6 text-center text-gray-500">
            Nog geen meldingen.
        </div>
        @endforelse
    </div>

</x-base-layout>