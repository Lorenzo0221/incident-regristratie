<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Incident Map Data
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">
                            Bron:
                            @if($fromCache)
                                <span class="font-semibold text-amber-600">cache (database)</span>
                            @else
                                <span class="font-semibold text-green-700">live API refresh</span>
                            @endif
                        </p>
                    </div>

                    <form method="POST" action="{{ route('incidents.map.refresh') }}">
                        @csrf
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Refresh Nu
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold mb-3">Live Map</h3>
                    <div class="w-full rounded-md overflow-hidden border border-gray-200" style="height: 70vh;">
                        <iframe
                            src="https://incident-nl.netlify.app/"
                            width="100%"
                            height="100%"
                            frameborder="0"
                            style="border: none; min-height: 100%;"
                        ></iframe>
                    </div>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 pr-4">Service</th>
                                <th class="text-left py-2 pr-4">Plaats</th>
                                <th class="text-left py-2 pr-4">Straat</th>
                                <th class="text-left py-2 pr-4">Beschrijving</th>
                                <th class="text-left py-2 pr-4">Lat</th>
                                <th class="text-left py-2 pr-4">Lng</th>
                                <th class="text-left py-2 pr-4">Opgehaald</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incidents as $incident)
                                <tr class="border-b align-top">
                                    <td class="py-2 pr-4">{{ $incident->service }}</td>
                                    <td class="py-2 pr-4">{{ $incident->place }}</td>
                                    <td class="py-2 pr-4">{{ $incident->street }}</td>
                                    <td class="py-2 pr-4">{{ $incident->description }}</td>
                                    <td class="py-2 pr-4">{{ number_format($incident->latitude, 6) }}</td>
                                    <td class="py-2 pr-4">{{ number_format($incident->longitude, 6) }}</td>
                                    <td class="py-2 pr-4">{{ optional($incident->fetched_at)->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-gray-500">
                                        Geen incidents gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
