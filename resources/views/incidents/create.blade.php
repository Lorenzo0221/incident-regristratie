@extends('layouts.app')

@section('content')

<h1>Incident melden</h1>

<form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
        <div style="color: #b91c1c; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="text" name="title" placeholder="Titel" value="{{ old('title') }}"><br><br>

    <textarea name="description" placeholder="Beschrijving">{{ old('description') }}</textarea><br><br>

    <input type="text" name="location" placeholder="Locatie" value="{{ old('location') }}"><br><br>

    <select name="type">
        <option value="geweld" @selected(old('type') === 'geweld')>Geweld</option>
        <option value="ongeval" @selected(old('type') === 'ongeval')>Ongeval</option>
        <option value="diefstal" @selected(old('type') === 'diefstal')>Diefstal</option>
    </select><br><br>

    <input type="datetime-local" name="incident_at" value="{{ old('incident_at') }}"><br><br>

    <select name="status">
        <option value="nieuw" @selected(old('status', 'nieuw') === 'nieuw')>Nieuw</option>
        <option value="in_behandeling" @selected(old('status') === 'in_behandeling')>In behandeling</option>
        <option value="wachten" @selected(old('status') === 'wachten')>Wachten</option>
        <option value="opgelost" @selected(old('status') === 'opgelost')>Opgelost</option>
        <option value="gesloten" @selected(old('status') === 'gesloten')>Gesloten</option>
    </select><br><br>

    <select name="priority">
        <option value="laag" @selected(old('priority') === 'laag')>Laag</option>
        <option value="normaal" @selected(old('priority', 'normaal') === 'normaal')>Normaal</option>
        <option value="hoog" @selected(old('priority') === 'hoog')>Hoog</option>
        <option value="urgent" @selected(old('priority') === 'urgent')>Urgent</option>
    </select><br><br>

    <input type="file" name="attachment"><br><br>

    <button type="submit">Versturen</button>
</form>

@endsection
