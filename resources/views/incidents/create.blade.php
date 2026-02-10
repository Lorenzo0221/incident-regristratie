<!-- resources/views/incidents/create.blade.php -->
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

    <button type="submit">Versturen</button>
</form>
