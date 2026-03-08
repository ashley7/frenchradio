@extends('layouts.app')

@section('content')

 <style>
         body {
        background: url('{{ asset("images/radio-studio-bg.jpg") }}') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }

    .overlay {
        background-color: rgba(0, 0, 0, 0.75);
        padding: 50px 0;
        min-height: 100vh;
    }

     </style>

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

                  
                       @if($p->audio_file || $p->you_tube_embed_url)
                            <div class="mb-3" style="height: 200px">

                            
                                @if($p->audio_file)
                                    <div id="waveform-{{ $p->id }}"></div>
                                @endif

                         
                                @if($p->you_tube_embed_url)
                                    <div class="embed-responsive embed-responsive-16by9 mb-2">
                                        <iframe class="embed-responsive-item"
                                                src="{{ $p->you_tube_embed_url }}"
                                                allowfullscreen></iframe>
                                    </div>
                                @endif

                           
                                <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap gap-5">

                               
                                    @if($p->audio_file)
                                        <button class="btn btn-sm btn-outline-primary"
                                                onclick="togglePlay({{ $p->id }})">
                                            ▶️ Play / Pause
                                        </button>
                                    @endif

                             
                                    <a href="{{ url('podcasts/'.$p->id) }}" class="btn btn-sm btn-outline-primary">
                                        ℹ️ Details
                                    </a>

                         
                                    @if($p->audio_file)
                                        <span id="timer-{{ $p->id }}">00:00 / 00:00</span>
                                    @endif

                                </div>
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