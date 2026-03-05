<x-base-layout>
    <form method="GET" class="mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Locatie</label>
            <input type="text" name="location" id="location" value="{{ request('location') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label for="date_from" class="block text-sm font-medium text-gray-700">Van datum</label>
            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label for="date_to" class="block text-sm font-medium text-gray-700">Tot datum</label>
            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Alle --</option>
                <option value="open" @selected(request('status')==='open' )>Open</option>
                <option value="in_behandeling" @selected(request('status')==='in_behandeling' )>In behandeling</option>
                <option value="afgehandeld" @selected(request('status')==='afgehandeld' )>Afgehandeld</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
        </div>
    </form>
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
               <a href="{{ route('incidents.show', $incident) }}" class="text-blue-600 hover:underline">
                    Bekijk details
                </a>
                <p class="text-sm text-gray-600 mt-1">
                    📍Locatie: {{ $incident->location ?? 'Onbekend' }}
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
