@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="management">
        @include('components.asideManagement')

        <section id="logo" class="row">
            <select name="species" id="speciesDropdown" class="form-control">
                @foreach ($species as $specie)
                    <option value="{{ $specie->id }}">{{ $specie->common_name }} ({{ $specie->scientific_name }})</option>
                @endforeach
            </select>

            <article class="box__logo">
                @include('partials.speciesGraph', [
                    'data' => $speciesData[$species->first()->id ?? 0] ?? [],
                ])
            </article>
        </section>
    </main>
@endsection
