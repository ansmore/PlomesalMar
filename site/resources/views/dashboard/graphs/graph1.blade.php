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
            <form method="GET" action="{{ route('dashboard.graph1', app()->getLocale()) }}" id="filterForm">
                <select name="species" id="speciesDropdown" class="form-control">
                    @foreach ($species as $specie)
                        <option value="{{ $specie->id }}" {{ $specie->id == $selectedSpecieId ? 'selected' : '' }}>
                            {{ $specie->common_name }} ({{ $specie->scientific_name }})
                        </option>
                    @endforeach
                </select>

                <select name="year" id="yearDropdown" class="form-control">
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

            <article class="box__logo">
                @include('partials.speciesGraph1', [
                    'data' => $speciesData[$selectedSpecieId] ?? [],
                ])
            </article>
        </section>
    </main>
@endsection
