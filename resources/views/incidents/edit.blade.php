<x-base-layout pageTitle="Incident bewerken" pageSubtitle="Wijzig de gegevens van deze melding">

    <div class="max-w-xl bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold mb-6">Incident bewerken</h2>

        <form method="POST"
              action="{{ route('incidents.update', $incident) }}"
              enctype="multipart/form-data"
              class="space-y-4">

            @csrf
            @method('PUT')

            {{-- Titel --}}
            <div>
                <label class="block text-sm font-medium mb-1">Titel</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $incident->title) }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                    required>
            </div>

            {{-- Beschrijving --}}
            <div>
                <label class="block text-sm font-medium mb-1">Beschrijving</label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                    required>{{ old('description', $incident->description) }}</textarea>
            </div>

            {{-- Locatie --}}
            <div>
                <label class="block text-sm font-medium mb-1">Locatie</label>
                <input
                    type="text"
                    name="location"
                    value="{{ old('location', $incident->location) }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium mb-1">Type incident</label>
                <select
                    name="type"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option value="geweld" @selected(old('type', $incident->type) === 'geweld')>Geweld</option>
                    <option value="ongeval" @selected(old('type', $incident->type) === 'ongeval')>Ongeval</option>
                    <option value="diefstal" @selected(old('type', $incident->type) === 'diefstal')>Diefstal</option>
                </select>
            </div>

            {{-- Datum & tijd --}}
            <div>
                <label class="block text-sm font-medium mb-1">Incident datum</label>
                <input
                    type="datetime-local"
                    name="incident_at"
                    value="{{ old('incident_at', \Carbon\Carbon::parse($incident->incident_at)->format('Y-m-d\TH:i')) }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- Bijlage --}}
            <div>
                <label class="block text-sm font-medium mb-1">Bijlage (optioneel)</label>

                @if($incident->attachment)
                    <p class="text-sm mb-2">
                        Huidige bijlage:
                        <a href="{{ asset('storage/' . $incident->attachment) }}"
                           target="_blank"
                           class="text-blue-600 hover:underline">
                            Bekijk
                        </a>
                    </p>
                @endif

                <input
                    type="file"
                    name="attachment"
                    class="w-full text-sm">
            </div>

            {{-- Acties --}}
            <div class="flex justify-between items-center pt-4">

                <a href="{{ route('incidents.show', $incident) }}"
                   class="text-slate-600 hover:underline">
                    ← Annuleren
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold px-6 py-3 rounded-xl
                           transition">
                    💾 Opslaan
                </button>

            </div>

        </form>
    </div>

</x-base-layout>
