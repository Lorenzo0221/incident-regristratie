<x-base-layout>
    <h1 class="text-2xl font-bold mb-6">Incident bewerken</h1>

    @if ($errors->any())
        <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('incidents.update', $incident) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Titel</label>
            <input type="text" name="title" value="{{ old('title', $incident->title) }}" class="w-full rounded border-gray-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Beschrijving</label>
            <textarea name="description" rows="4" class="w-full rounded border-gray-300" required>{{ old('description', $incident->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Locatie</label>
            <input type="text" name="location" value="{{ old('location', $incident->location) }}" class="w-full rounded border-gray-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <select name="type" class="w-full rounded border-gray-300" required>
                <option value="geweld" @selected(old('type', $incident->type) === 'geweld')>Geweld</option>
                <option value="ongeval" @selected(old('type', $incident->type) === 'ongeval')>Ongeval</option>
                <option value="diefstal" @selected(old('type', $incident->type) === 'diefstal')>Diefstal</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Incident datum</label>
            <input type="datetime-local" name="incident_at"
                value="{{ old('incident_at', \Illuminate\Support\Carbon::parse($incident->incident_at)->format('Y-m-d\\TH:i')) }}"
                class="w-full rounded border-gray-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full rounded border-gray-300" required>
                <option value="nieuw" @selected(old('status', $incident->status) === 'nieuw')>Nieuw</option>
                <option value="in_behandeling" @selected(old('status', $incident->status) === 'in_behandeling')>In behandeling</option>
                <option value="wachten" @selected(old('status', $incident->status) === 'wachten')>Wachten</option>
                <option value="opgelost" @selected(old('status', $incident->status) === 'opgelost')>Opgelost</option>
                <option value="gesloten" @selected(old('status', $incident->status) === 'gesloten')>Gesloten</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Prioriteit</label>
            <select name="priority" class="w-full rounded border-gray-300" required>
                <option value="laag" @selected(old('priority', $incident->priority) === 'laag')>Laag</option>
                <option value="normaal" @selected(old('priority', $incident->priority) === 'normaal')>Normaal</option>
                <option value="hoog" @selected(old('priority', $incident->priority) === 'hoog')>Hoog</option>
                <option value="urgent" @selected(old('priority', $incident->priority) === 'urgent')>Urgent</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Bijlage (optioneel)</label>
            @if ($incident->attachment)
                <p class="text-sm mb-2">
                    Huidige bijlage:
                    <a href="{{ asset('storage/' . $incident->attachment) }}" target="_blank" class="text-blue-600 hover:underline">Bekijk</a>
                </p>
            @endif
            <input type="file" name="attachment" class="w-full text-sm">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-white">Opslaan</button>
            <a href="{{ route('incidents.show', $incident) }}" class="rounded border border-gray-300 px-4 py-2">Annuleren</a>
        </div>
    </form>
</x-base-layout>
