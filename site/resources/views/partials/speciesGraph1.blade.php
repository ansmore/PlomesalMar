<div id="chartData" data-labels='@json($labels)' data-series='@json($speciesData[$selectedSpecieId] ?? [])'>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        localStorage.setItem('speciesData', '@json($speciesData)');
        console.log('speciesData set in localStorage:', localStorage.getItem('speciesData'));
    </script>
    <script type="module" src="{{ asset('js/partials/graph.js') }}" defer></script>
@endpush
