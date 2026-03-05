<x-base-layout>
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Totaal aantal incidenten</div>
                <div class="text-3xl font-bold">{{ $incidents->count() }}</div>
            </div>
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Open</div>
                <div class="text-3xl font-bold">{{ $incidents->where('status', 'open')->count() }}</div>
            </div>
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Afgehandeld</div>
                <div class="text-3xl font-bold">{{ $incidents->where('status', 'afgehandeld')->count() }}</div>
            </div>
        </div>
        <div class="mb-6">
            <div class="p-4 bg-white dark:bg-gray-800 rounded shadow mb-2">
                <span class="text-gray-900 dark:text-gray-100">Welkom op het dashboard!</span>
            </div>
            <a href="{{ route('incidents.export.pdf') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-fit">
                ⬇️ Exporteren incidenten naar PDF
            </a>
        </div>
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4">Incidenten per locatie</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($perLocation as $row)
                <div class="bg-blue-100 rounded shadow p-4">
                    <div class="text-gray-700 font-medium">{{ $row->location }}</div>
                    <div class="text-2xl font-bold">{{ $row->total }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4">Incidenten per maand</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($perMonth as $row)
                <div class="bg-green-100 rounded shadow p-4">
                    <div class="text-gray-700 font-medium">{{ $row->month }}</div>
                    <div class="text-2xl font-bold">{{ $row->total }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-base-layout>