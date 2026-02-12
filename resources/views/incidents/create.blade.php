<x-base-layout>
    <h1>Incident melden</h1>

    <form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Titel"><br><br>

        <textarea name="description" placeholder="Beschrijving"></textarea><br><br>

        <input type="text" name="location" placeholder="Locatie"><br><br>

        <select name="type">
            <option value="geweld">Geweld</option>
            <option value="ongeval">Ongeval</option>
            <option value="diefstal">Diefstal</option>
        </select><br><br>

        <input type="datetime-local" name="incident_at"><br><br>

        <input type="file" name="attachment"><br><br>

        <button
            type="submit"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
           text-white font-semibold px-6 py-3 rounded-xl
           shadow-md hover:shadow-lg
           transition duration-200 ease-in-out
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            🚀 Versturen
        </button>
    </form>
</x-base-layout>