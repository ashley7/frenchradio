@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ $lesson->title }}</h3>

        <p>
        <strong>Program:</strong>
        {{ $lesson->program->title ?? '' }}
        </p>

        <p>
        <strong>Objectives</strong><br>
        {{ $lesson->learning_objectives }}
        </p>

        <p>
        <strong>Content</strong><br>
        {{ $lesson->content }}
        </p>

        @if($lesson->downloadable_material)

            <a href="{{ asset('storage/'.$lesson->downloadable_material) }}"
            class="btn btn-info">

            Download Material

            </a>

        @endif

    </div>

@endsection