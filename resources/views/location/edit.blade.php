<x-base-layout>
    <h1 class="text-2xl font-bold mb-6">Locatie bewerken</h1>
    <form method="POST" action="{{ route('locations.update', $location) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}" class="w-full border rounded-lg p-2 mt-1" required>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Opslaan</button>
            <a href="{{ route('locations.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Annuleren</a>
        </div>
    </form>
</x-base-layout>