<form method="GET" action="{{ route('dashboard.donutGraph', app()->getLocale()) }}">
    <label for="departure_id">Select a Departure Date:</label>
    <select name="departure_id" id="departure_id" onchange="this.form.submit()">
        <option value="">--Select--</option>
        @foreach ($departures as $departure)
            <option value="{{ $departure->id }}" {{ request('departure_id') == $departure->id ? 'selected' : '' }}>
                {{ $departure->date }}
            </option>
        @endforeach
    </select>
</form>

@if (request('departure_id') && count($observations) > 0)
    <h2>Observations for Departure on {{ $departures->find(request('departure_id'))->date }}</h2>
    <div style="width: 800px; height: 600px;">
        <canvas id="donutChart"></canvas>
    </div>
    <div id="observation-data" data-observations="{{ json_encode($observations) }}"></div>
@elseif(request('departure_id'))
    <p>No observations found for this departure.</p>
@endif
