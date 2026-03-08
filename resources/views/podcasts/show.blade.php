@extends('layouts.app')

@section('content')
<div class="container mt-5">

    @auth
        <a href="{{ route('podcast_lessons.create') }}">Add Lessons</a>
    @endauth

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="card-title font-weight-bold">{{ $podcast->title }}</h2>
            <p>{{ $podcast->description }}</p>
            <p class="text-muted small">Posted: {{ $podcast->created_at->diffForHumans() }}</p>

            {{-- Audio Waveform --}}
            @if($podcast->audio_file)
                <div class="mb-3">
                    <div id="waveform-{{ $podcast->id }}"></div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-sm btn-outline-primary" onclick="togglePlay({{ $podcast->id }})">
                            Play / Pause
                        </button>
                        <span id="timer-{{ $podcast->id }}">00:00 / 00:00</span>
                    </div>
                </div>
            @endif

            {{-- YouTube Video --}}
            @if($podcast->you_tube_embed_url)
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                            src="{{ $podcast->you_tube_embed_url }}"
                            allowfullscreen></iframe>
                </div>
            @endif
        </div>
    </div>

    {{-- Lessons --}}
    <h4 class="mb-3">Lessons</h4>
    @foreach($podcast->lessons as $lesson)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $lesson->key_themes }}</h5>
                <p><strong>Learning Outcomes:</strong> {{ $lesson->learning_outcomes }}</p>
                <p><strong>Practical Applications:</strong> {{ $lesson->practical_applications }}</p>

                {{-- Lesson Questions --}}
                @if($lesson->questions->count())
                    <h6>Discussion Questions:</h6>
                    <ul>
                        @foreach($lesson->questions as $q)
                            <li>{{ $q->question }}</li>
                        @endforeach
                    </ul>
                @endif

                {{-- Mark Lesson Complete --}}
                @auth
                    @php
                        $completed = $userProgress[$lesson->id] ?? false;
                    @endphp

                    
                @endauth
            </div>
        </div>
    @endforeach

</div>

{{-- Wavesurfer.js --}}
<script src="https://unpkg.com/wavesurfer.js"></script>
<script>
    const waves = {};
    @if($podcast->audio_file)
        waves[{{ $podcast->id }}] = WaveSurfer.create({
            container: '#waveform-{{ $podcast->id }}',
            waveColor: '#007bff',
            progressColor: '#0056b3',
            height: 80,
            responsive: true
        });
        waves[{{ $podcast->id }}].load('{{ asset("storage/".$podcast->audio_file) }}');

        waves[{{ $podcast->id }}].on('ready', function () {
            const duration = waves[{{ $podcast->id }}].getDuration();
            document.getElementById('timer-{{ $podcast->id }}').innerText = formatTime(0) + ' / ' + formatTime(duration);
        });

        waves[{{ $podcast->id }}].on('audioprocess', function () {
            const currentTime = waves[{{ $podcast->id }}].getCurrentTime();
            const duration = waves[{{ $podcast->id }}].getDuration();
            document.getElementById('timer-{{ $podcast->id }}').innerText = formatTime(currentTime) + ' / ' + formatTime(duration);
        });

        waves[{{ $podcast->id }}].on('finish', function () {
            document.getElementById('timer-{{ $podcast->id }}').innerText = formatTime(0) + ' / ' + formatTime(waves[{{ $podcast->id }}].getDuration());
        });

        function togglePlay(id) {
            if (waves[id]) waves[id].playPause();
        }

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = Math.floor(seconds % 60);
            return `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
        }
    @endif
</script>
@endsection