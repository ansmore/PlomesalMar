@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="management">
        @include('components.asideMenu')

        <section id="logo" class="row">
            <form id="multiGraphForm1" action="{{ route('dashboard.multiGraph', app()->getLocale()) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="year1">Seleccione el Año 1:</label>
                    <select id="year1" name="year1" class="form-control">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $year == $selectedYear1 ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="species_id1">Seleccione la Especie 1:</label>
                    <select id="species_id1" name="species_id1" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}"
                                {{ isset($selectedSpeciesIds[0]) && $selectedSpeciesIds[0] == $specie->id ? 'selected' : '' }}>
                                {{ $specie->common_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="species_id2">Seleccione la Especie 2:</label>
                    <select id="species_id2" name="species_id2" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}"
                                {{ isset($selectedSpeciesIds[1]) && $selectedSpeciesIds[1] == $specie->id ? 'selected' : '' }}>
                                {{ $specie->common_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="species_id3">Seleccione la Especie 3:</label>
                    <select id="species_id3" name="species_id3" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}"
                                {{ isset($selectedSpeciesIds[2]) && $selectedSpeciesIds[2] == $specie->id ? 'selected' : '' }}>
                                {{ $specie->common_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="species_id4">Seleccione la Especie 4:</label>
                    <select id="species_id4" name="species_id4" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}"
                                {{ isset($selectedSpeciesIds[3]) && $selectedSpeciesIds[3] == $specie->id ? 'selected' : '' }}>
                                {{ $specie->common_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="species_id5">Seleccione la Especie 5:</label>
                    <select id="species_id5" name="species_id5" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}"
                                {{ isset($selectedSpeciesIds[4]) && $selectedSpeciesIds[4] == $specie->id ? 'selected' : '' }}>
                                {{ $specie->common_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="button" id="updateGraphButton1" class="btn btn-primary">Actualizar Gráfico 1</button>
            </form>

            <form id="multiGraphForm2" action="{{ route('dashboard.multiGraph', app()->getLocale()) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="year2">Seleccione el Año 2:</label>
                    <select id="year2" name="year2" class="form-control">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $year == $selectedYear2 ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="updateGraphButton2" class="btn btn-primary">Actualizar Gráfico 2</button>
            </form>

            <article id="multiGraphContainer">
                <div class="chart-container">
                    @include('partials.multiGraph1')
                </div>
                <div class="chart-container">
                    @include('partials.multiGraph2')
                </div>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="{{ asset('js/partials/multiGraph.js') }}" defer></script>
@endpush
