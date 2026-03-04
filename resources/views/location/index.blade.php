<x-base-layout>
    <h1 class="text-2xl font-bold mb-6">Locaties</h1>
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Naam</th>
                    <th class="px-4 py-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $location->name }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('locations.edit', $location) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs">✏️</a>
                        <form action="{{ route('locations.destroy', $location) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze locatie wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($locations->isEmpty())
        <div class="text-gray-500 mt-4">Geen locaties gevonden.</div>
        @endif
    </div>
</x-base-layout>