@extends('layouts.main')

@section('title', 'Error 403')
@section('content')

    <main class="management">
        <section id="head" class="row">
            <article class="card">
                <span class="card-header">Error 403: Sóc una tetera</span>
                <div class="card-body">
                    <p>
                        ¡Ho lamento, sóc una tetera! 😄
                    </p>
                    <p>
                        {{ $exeption->getMessage() }} 😄
                    </p>
                    <p>
                        @if (isset($exception) && !empty($exception->getMessage()))
                            {{ $exception->getMessage() }}
                        @endif
                    </p>
                </div>
            </article>
        </section>
    </main>
@endsection
