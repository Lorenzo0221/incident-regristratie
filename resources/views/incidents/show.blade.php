<x-base-layout>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $incident->title }}</h1>
            <p class="text-sm text-slate-500">Gemeld op {{ $incident->created_at->format('d M Y H:i') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('incidents.edit', $incident) }}" class="rounded border border-gray-300 px-4 py-2">Bewerken</a>
            <a href="{{ route('incidents.index') }}" class="rounded border border-gray-300 px-4 py-2">Terug</a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6 space-y-4">
        <div>
            <div class="text-sm text-slate-500">Beschrijving</div>
            <div class="text-slate-800">{{ $incident->description }}</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <div class="text-slate-500">Type</div>
                <div class="font-medium capitalize">{{ $incident->type }}</div>
            </div>
            <div>
                <div class="text-slate-500">Locatie</div>
                <div class="font-medium">{{ $incident->location }}</div>
            </div>
            <div>
                <div class="text-slate-500">Incident datum</div>
                <div class="font-medium">{{ optional($incident->incident_at)->format('d M Y H:i') }}</div>
            </div>
            <div>
                <div class="text-slate-500">Status</div>
                <div class="font-medium">{{ str_replace('_', ' ', $incident->status) }}</div>
            </div>
            <div>
                <div class="text-slate-500">Prioriteit</div>
                <div class="font-medium">{{ $incident->priority }}</div>
            </div>
            <div>
                <div class="text-slate-500">Verantwoordelijke</div>
                <div class="font-medium">{{ $incident->assignee?->name ?? 'Niet toegewezen' }}</div>
            </div>
        </div>

        @if ($incident->attachment)
            <div>
                <div class="text-sm text-slate-500">Bijlage</div>
                <a href="{{ asset('storage/' . $incident->attachment) }}" target="_blank" class="text-blue-600 hover:underline">
                    Bekijk bestand
                </a>
            </div>
        @endif
    </div>
</x-base-layout>
