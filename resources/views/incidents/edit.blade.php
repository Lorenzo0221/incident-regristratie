@extends('layouts.app')

@section('content')

<h1>Incident bewerken</h1>

<form method="POST" action="{{ route('incidents.update', $incident) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div style="color: #b91c1c; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input
        type="text"
        name="title"
        placeholder="Titel"
        value="{{ old('title', $incident->title) }}"
    ><br><br>

    <textarea
        name="description"
        placeholder="Beschrijving"
    >{{ old('description', $incident->description) }}</textarea><br><br>

    <input
        type="text"
        name="location"
        placeholder="Locatie"
        value="{{ old('location', $incident->location) }}"
    ><br><br>

    <select name="type">
        <option value="geweld" @selected(old('type', $incident->type) === 'geweld')>Geweld</option>
        <option value="ongeval" @selected(old('type', $incident->type) === 'ongeval')>Ongeval</option>
        <option value="diefstal" @selected(old('type', $incident->type) === 'diefstal')>Diefstal</option>
    </select><br><br>

    <input
        type="datetime-local"
        name="incident_at"
        value="{{ old('incident_at', \Illuminate\Support\Carbon::parse($incident->incident_at)->format('Y-m-d\TH:i')) }}"
    ><br><br>

    <select name="status">
        <option value="nieuw" @selected(old('status', $incident->status) === 'nieuw')>Nieuw</option>
        <option value="in_behandeling" @selected(old('status', $incident->status) === 'in_behandeling')>In behandeling</option>
        <option value="wachten" @selected(old('status', $incident->status) === 'wachten')>Wachten</option>
        <option value="opgelost" @selected(old('status', $incident->status) === 'opgelost')>Opgelost</option>
        <option value="gesloten" @selected(old('status', $incident->status) === 'gesloten')>Gesloten</option>
    </select><br><br>

    <select name="priority">
        <option value="laag" @selected(old('priority', $incident->priority) === 'laag')>Laag</option>
        <option value="normaal" @selected(old('priority', $incident->priority) === 'normaal')>Normaal</option>
        <option value="hoog" @selected(old('priority', $incident->priority) === 'hoog')>Hoog</option>
        <option value="urgent" @selected(old('priority', $incident->priority) === 'urgent')>Urgent</option>
    </select><br><br>

    @if($incident->attachment)
        <p>
            Huidige bijlage:
            <a href="{{ asset('storage/' . $incident->attachment) }}" target="_blank">Bekijk bestand</a>
        </p><br>
    @endif

    <input type="file" name="attachment"><br><br>

    <button type="submit">Opslaan</button>
</form>

@endsection
