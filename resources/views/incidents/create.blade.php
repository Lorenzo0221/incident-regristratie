<x-base-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900">Incident melden</h1>
            <p class="text-slate-600 mt-1">Vul de gegevens hieronder in om een nieuwe melding te registreren.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                <p class="font-semibold mb-2">Controleer je invoer:</p>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Titel</label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Bijv. Verkeersongeval op A2"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Beschrijving</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Beschrijf kort wat er is gebeurd..."
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    >{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="location" class="block text-sm font-medium text-slate-700 mb-1">Locatie</label>
                        <select
                            id="location"
                            name="location"
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">-- Kies locatie --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->name }}" @selected(old('location') === $location->name)>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-slate-700 mb-1">Type</label>
                        <select
                            id="type"
                            name="type"
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="geweld" @selected(old('type') === 'geweld')>Geweld</option>
                            <option value="ongeval" @selected(old('type') === 'ongeval')>Ongeval</option>
                            <option value="diefstal" @selected(old('type') === 'diefstal')>Diefstal</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="incident_at" class="block text-sm font-medium text-slate-700 mb-1">Datum en tijd</label>
                        <input
                            id="incident_at"
                            type="datetime-local"
                            name="incident_at"
                            value="{{ old('incident_at') }}"
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label for="attachment" class="block text-sm font-medium text-slate-700 mb-1">Bijlage</label>
                        <input
                            id="attachment"
                            type="file"
                            name="attachment"
                            class="w-full rounded-lg border-slate-300 text-slate-700 file:mr-4 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-2 file:text-sm file:font-medium hover:file:bg-slate-200"
                        >
                    </div>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Incident versturen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
