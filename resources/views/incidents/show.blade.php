<x-base-layout pageTitle="Incident details" pageSubtitle="Overzicht van het gemelde incident">

    <div class="max-w-3xl bg-white rounded-2xl shadow p-6 space-y-6">

        {{-- Titel --}}
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                {{ $incident->title }}
            </h2>
            <p class="text-sm text-slate-500">
                Gemeld op {{ $incident->created_at->format('d M Y H:i') }}
            </p>
        </div>

        {{-- Meta info --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-slate-500">Type</span><br>
                <span class="font-medium capitalize">{{ $incident->type }}</span>
            </div>

            <div>
                <span class="text-slate-500">Locatie</span><br>
                <span class="font-medium">{{ $incident->location }}</span>
            </div>

            <div>
                <span class="text-slate-500">Incident datum</span><br>
                <span class="font-medium">
                    {{ \Carbon\Carbon::parse($incident->incident_at)->format('d M Y H:i') }}
                </span>
            </div>
        </div>

        {{-- Beschrijving --}}
        <div>
            <h3 class="text-lg font-semibold mb-2">Beschrijving</h3>
            <p class="text-slate-700 leading-relaxed">
                {{ $incident->description }}
            </p>
        </div>

        {{-- Bijlage --}}
        @if($incident->attachment)
            <div>
                <h3 class="text-lg font-semibold mb-2">Bijlage</h3>
                <a href="{{ asset('storage/' . $incident->attachment) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                    📎 Bekijk bijlage
                </a>
            </div>
        @endif

        {{-- Acties --}}
        <div class="flex gap-3 pt-4 border-t">
            <a href="{{ route('incidents.index') }}"
               class="px-4 py-2 rounded-xl border border-slate-300
                      text-slate-700 hover:bg-slate-100 transition">
                ← Terug
            </a>

            <a href="{{ route('incidents.edit', $incident) }}"
               class="px-4 py-2 rounded-xl bg-blue-600 text-white
                      hover:bg-blue-700 transition">
                ✏️ Bewerken
            </a>
        </div>

    </div>

</x-base-layout>
