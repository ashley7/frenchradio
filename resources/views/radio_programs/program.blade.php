@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header d-flex justify-content-between">

                    <h4>{{ $program->title }}</h4>

                    {{-- STATUS BADGE --}}
                    @if($program->is_live)
                        <span class="badge bg-danger">LIVE</span>

                    @elseif($program->is_upcoming)
                        <span class="badge bg-warning text-dark">UPCOMING</span>

                    @elseif($program->is_ended)
                        <span class="badge bg-secondary">ENDED</span>
                    @endif

                </div>

                <div class="card-body">

                    <p>
                        <strong>Description</strong><br>
                        {{ $program->description }}
                    </p>

                    <hr>

                    <p>
                        <strong>Start Time</strong><br>
                        {{ $program->start_time }}
                    </p>

                    <p>
                        <strong>End Time</strong><br>
                        {{ $program->end_time }}
                    </p>


                    {{-- LIVE STREAM --}}
                    @if($program->is_live && $program->stream_url)

                        <hr>

                        <h5 class="text-danger">🔴 Live Broadcast</h5>

                        <audio controls autoplay class="w-100">
                            <source src="{{ $program->stream_url }}">
                            Your browser does not support audio.
                        </audio>

                    @endif


                    {{-- UPCOMING --}}
                    @if($program->is_upcoming)

                        <hr>

                        <div class="alert alert-warning">

                            This program will start at  
                            <strong>{{ $program->start_time }}</strong>

                        </div>

                    @endif


                    {{-- RECORDED PROGRAM --}}
                    @if($program->is_ended && $program->recorded_file)

                        <hr>

                        <h5>Program Recording</h5>

                        <audio controls class="w-100">
                            <source src="{{ asset('storage/'.$program->recorded_file) }}">
                        </audio>

                    @endif


                    <hr>

                    <a href="{{ route('radio-programs.index') }}" class="btn btn-secondary">
                        Back to Programs
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection