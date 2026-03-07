@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Radio Programs</h3>

        <a href="{{ route('radio-programs.create') }}" class="btn btn-primary">
            Add Program
        </a>
    </div>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Scheduled</th>            
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach($programs as $program)

            <tr>
                <td>{{ $program->id }}</td>

                <td>{{ $program->title }}</td>              

                <td>
                    @if ($program->status == "ended")
                        <span class="badge bg-dark text-white">Ended</span>         
                    @elseif($program->status=='upcoming')
                        <span>Start time: {{$program->start_time .' to '.$program->end_time}}</span>
                    @elseif($program->status=='live')
                        <span class="badge bg-success">Live - Ends at{{ $program->end_time }}</span>        
                    @endif
                </td>

                <td>

                    <a href="{{ route('radio-programs.show',$program->id) }}" 
                       class="btn btn-sm btn-info">
                        View
                    </a>

                    <a href="{{ route('radio-programs.edit',$program->id) }}" 
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                  <form action="{{ route('radio-programs.destroy',$program->id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete program?')"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this program?')">

                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    {{ $programs->links() }}

</div>

@endsection