@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4 text-center">Listen to Our Podcasts</h2>

    <div class="row">

        @foreach($podcasts as $p)

            <div class="col-md-4">

                <div class="card mb-4 shadow-sm">

                    <div class="card-body">

                        <h5 class="card-title font-weight-bold">
                            {{ $p->title }}
                        </h5>

                       

                        <p class="text-muted small">
                            Posted: {{ $p->created_at->format('d M Y  j:s A') }}
                        </p>

                        {{-- Audio with Wavesurfer.js + Timer --}}
                        @if($p->audio_file)
                            <div class="mb-3">
                                <div id="waveform-{{ $p->id }}"></div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <button class="btn btn-sm btn-outline-primary"
                                            onclick="togglePlay({{ $p->id }})">
                                        Play / Pause
                                    </button>

                                    <a href="{{url('podcasts/'.$p->id)}}" class="btn btn-sm btn-outline-primary"
                                            onclick="togglePlay({{ $p->id }})">
                                        Details
                                    </a>
                                    <span id="timer-{{ $p->id }}">00:00 / 00:00</span>
                                </div>
                            </div>
                        @endif

                        {{-- YouTube Video --}}
                        @if($p->you_tube_embed_url)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                        src="{{ $p->you_tube_embed_url }}"
                                        allowfullscreen>
                                </iframe>

                                <a href="{{url('podcasts/'.$p->id)}}" class="btn btn-sm btn-outline-primary"
                                            onclick="togglePlay({{ $p->id }})">
                                        Details
                                    </a>
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

{{-- Wavesurfer.js --}}
<script src="https://unpkg.com/wavesurfer.js"></script>
<script>
    const waves = {};

    @foreach($podcasts as $p)
        @if($p->audio_file)
            waves[{{ $p->id }}] = WaveSurfer.create({
                container: '#waveform-{{ $p->id }}',
                waveColor: '#007bff',
                progressColor: '#0056b3',
                height: 80,
                responsive: true
            });
            waves[{{ $p->id }}].load('{{ asset("storage/".$p->audio_file) }}');

            // Update timer
            waves[{{ $p->id }}].on('ready', function () {
                const duration = waves[{{ $p->id }}].getDuration();
                document.getElementById('timer-{{ $p->id }}').innerText = formatTime(0) + ' / ' + formatTime(duration);
            });

            waves[{{ $p->id }}].on('audioprocess', function () {
                const currentTime = waves[{{ $p->id }}].getCurrentTime();
                const duration = waves[{{ $p->id }}].getDuration();
                document.getElementById('timer-{{ $p->id }}').innerText = formatTime(currentTime) + ' / ' + formatTime(duration);
            });

            waves[{{ $p->id }}].on('finish', function () {
                document.getElementById('timer-{{ $p->id }}').innerText = formatTime(0) + ' / ' + formatTime(waves[{{ $p->id }}].getDuration());
            });
        @endif
    @endforeach

    function togglePlay(id) {
        if (waves[id]) waves[id].playPause();
    }

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60);
        const s = Math.floor(seconds % 60);
        return `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
    }
</script>

@endsection