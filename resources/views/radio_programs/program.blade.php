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

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow-sm border-primary">

                {{-- Program Header --}}
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">📻 {{ $program->title }}</h4>

                    @if($program->is_live)
                        <span class="badge bg-danger">🔴 LIVE</span>
                    @elseif($program->is_upcoming)
                        <span class="badge bg-warning text-dark">🟡 UPCOMING</span>
                    @elseif($program->is_ended)
                        <span class="badge bg-secondary">⚫ ENDED</span>
                    @endif
                </div>

                <div class="card-body">

                    {{-- Description --}}
                    <p>
                        <i class="bi bi-card-text"></i>
                        <strong>Description:</strong><br>
                        {{ $program->description }}
                    </p>

                    <hr>

                    {{-- Start / End Time --}}
                    <p>
                        <i class="bi bi-clock"></i>
                        <strong>Start Time:</strong> 
                        {{ \Carbon\Carbon::parse($program->start_time)->format('d M Y h:i A') }}
                    </p>
                    <p>
                        <i class="bi bi-clock-history"></i>
                        <strong>End Time:</strong> 
                        {{ \Carbon\Carbon::parse($program->end_time)->format('d M Y h:i A') }}
                    </p>

                    {{-- Live Stream --}}
                    @if($program->is_live && $program->stream_url)
                        <hr>
                        <h5 class="text-danger mb-3">🔴 Live Broadcast</h5>
                        <audio controls autoplay class="w-100 mb-3">
                            <source src="{{ $program->stream_url }}">
                            Your browser does not support audio.
                        </audio>
                    @endif

                    {{-- Upcoming Program Alert --}}
                    @if($program->is_upcoming)
                        <hr>
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-bell-fill me-2"></i>
                            This program will start at  
                            <strong>{{ \Carbon\Carbon::parse($program->start_time)->format('d M Y h:i A') }}</strong>
                        </div>
                    @endif

                    {{-- Recorded Program --}}
                    @if($program->is_ended && $program->recorded_file)
                        <hr>
                        <h5>📼 Program Recording</h5>
                        <audio controls class="w-100 mb-3">
                            <source src="{{ asset('storage/'.$program->recorded_file) }}">
                        </audio>
                    @endif

                    <hr>

                    <a href="{{ route('radio-programs.index') }}" class="btn btn-secondary">
                        ← Back to Programs
                    </a>

                </div>

                {{-- Lesson Plans --}}
                @if($program->lessonPlans->count())
                    <hr>
                    <div class="card-body">
                        <h4>📚 Lesson Plans</h4>
                        <table class="table table-hover table-bordered mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($program->lessonPlans as $lesson)
                                    <tr>
                                        <td>{{ $lesson->title }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('lesson-plans.show',$lesson->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info m-3">
                        <i class="bi bi-info-circle"></i> No lesson plans for this program.
                    </div>
                @endif

                <div class="container">
                 <div id="disqus_thread"></div>
                </div>

            </div>

        </div>

    </div>

   
<script>
    var disqus_config = function () {
    this.page.url = {!! url()->current() !!}
    this.page.identifier = {{ $program->id }}
    };
   
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://web-radio-frenchizly.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div>

@endsection