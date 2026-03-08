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

<div class="overlay">
    <div class="container">

        <div class="text-center mb-5">
            <a href="{{ url('listen/podcasts') }}" class="btn btn-lg btn-danger shadow">🎧 Listen to Podcasts</a>
        </div>

        {{-- LIVE PROGRAMS --}}
        <h2 class="section-title text-danger">🔴 Live Now</h2>
        <div class="row mb-5">
            @forelse($programs->where('is_live',true) as $program)
                <div class="col-md-4 mb-4">
                    <div class="card border-danger bg-dark text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text">{{ Str::limit($program->description,120) }}</p>

                            <span class="badge badge-live">LIVE</span>

                            @if($program->status == "live")
                                <div class="mt-3">                          
                                    <audio controls autoplay>
                                        <source src="{{ $program->stream_url }}" type="audio/mpeg">
                                    </audio>
                                </div>
                            @endif

                            <div class="mt-3">
                                <a href="{{ url('radioprograms/'.$program->id) }}" class="btn btn-sm btn-outline-danger">
                                    View Program
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-warning">No live programs right now.</p>
            @endforelse
        </div>

        {{-- UPCOMING PROGRAMS --}}
        <h2 class="section-title text-warning">🟡 Upcoming Programs</h2>
        <div class="row mb-5">
            @forelse($programs->where('is_upcoming',true) as $program)
                <div class="col-md-4 mb-4">
                    <div class="card border-warning bg-dark text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text">{{ Str::limit($program->description,120) }}</p>

                            <span class="badge badge-upcoming">UPCOMING</span>

                            <p class="mt-2"><strong>Starts:</strong><br>{{ $program->start_time }}</p>

                            <a href="{{ url('radioprograms/'.$program->id) }}" class="btn btn-sm btn-outline-warning">
                                View Program
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-warning">No upcoming programs.</p>
            @endforelse
        </div>

        {{-- ENDED PROGRAMS --}}
        <h2 class="section-title text-secondary">⚫ Past Programs</h2>
        <div class="row">
            @forelse($programs->where('is_ended',true) as $program)
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text">{{ Str::limit($program->description,120) }}</p>

                            <span class="badge badge-ended">ENDED</span>

                            @if($program->recorded_file)
                                <div class="mt-3">
                                    <audio controls>
                                        <source src="{{ asset('storage/'.$program->recorded_file) }}">
                                    </audio>
                                </div>
                            @endif

                            <div class="mt-3">
                                <a href="{{ url('radioprograms/'.$program->id) }}" class="btn btn-sm btn-outline-secondary">
                                    View Program
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-secondary">No past programs.</p>
            @endforelse
        </div>

    </div>
</div>

@endsection