@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Radio Programs</h2>


    {{-- LIVE PROGRAMS --}}
    <h4 class="mb-3 text-danger">🔴 Live Now</h4>

    <div class="row mb-5">

        @forelse($programs->where('is_live',true) as $program)

            <div class="col-md-4 mb-3">

                <div class="card border-danger">

                    <div class="card-body">

                        <h5>{{ $program->title }}</h5>

                        <p>{{ Str::limit($program->description,120) }}</p>

                        <span class="badge bg-danger">
                            LIVE
                        </span>

                        @if($program->status == "live")

                            <div class="mt-3">                          

                                <audio controls autoplay>
                                    <source src="{{ $program->stream_url }}" type="audio/mpeg">
                                </audio>

                            </div>

                        @endif

                        <div class="mt-3">
                            <a href="{{ route('radio-programs.show',$program->id) }}"
                               class="btn btn-sm btn-outline-danger">

                                View Program
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        @empty

            <p>No live programs right now.</p>

        @endforelse

    </div>



    {{-- UPCOMING PROGRAMS --}}
    <h4 class="mb-3 text-warning">🟡 Upcoming Programs</h4>

    <div class="row mb-5">

        @forelse($programs->where('is_upcoming',true) as $program)

            <div class="col-md-4 mb-3">

                <div class="card border-warning">

                    <div class="card-body">

                        <h5>{{ $program->title }}</h5>

                        <p>{{ Str::limit($program->description,120) }}</p>

                        <span class="badge bg-warning text-dark">
                            UPCOMING
                        </span>

                        <p class="mt-2">

                            <strong>Starts:</strong><br>
                            {{ $program->start_time }}

                        </p>

                        <a href="{{ url('radioprograms/'.$program->id) }}"
                           class="btn btn-sm btn-outline-warning">

                            View Program

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <p>No upcoming programs.</p>

        @endforelse

    </div>



    {{-- ENDED PROGRAMS --}}
    <h4 class="mb-3 text-secondary">⚫ Past Programs</h4>

    <div class="row">

        @forelse($programs->where('is_ended',true) as $program)

            <div class="col-md-4 mb-3">

                <div class="card">

                    <div class="card-body">

                        <h5>{{ $program->title }}</h5>

                        <p>{{ Str::limit($program->description,120) }}</p>

                        <span class="badge bg-secondary">
                            ENDED
                        </span>

                        @if($program->recorded_file)

                            <div class="mt-3">

                                <audio controls class="w-100">
                                    <source src="{{ asset('storage/'.$program->recorded_file) }}">
                                </audio>

                            </div>

                        @endif

                        <div class="mt-3">

                            <a href="{{ url('radioprograms/'.$program->id) }}"
                               class="btn btn-sm btn-outline-secondary">

                                View Program

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <p>No past programs.</p>

        @endforelse

    </div>

</div>

@endsection