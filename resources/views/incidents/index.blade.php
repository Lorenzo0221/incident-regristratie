<!-- resources/views/incidents/index.blade.php -->
<h1>Mijn meldingen</h1>

<a href="{{ route('incidents.create') }}">+ Nieuwe melding</a>

<ul>
@foreach ($incidents as $incident)
    <li>
        <strong>{{ $incident->title }}</strong><br>
        Status: {{ $incident->status }}<br>
        Datum: {{ $incident->incident_at }}
    </li>
@endforeach
</ul>
