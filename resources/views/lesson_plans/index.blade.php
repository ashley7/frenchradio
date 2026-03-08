@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Lesson Plans</h3>

        <a href="{{ route('lesson-plans.create') }}"
        class="btn btn-primary mb-3">

        Create Lesson

        </a>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Program</th>
                <th>Actions</th>
            </tr>

            @foreach($lessons as $lesson)

            <tr>

                <td>{{ $lesson->id }}</td>

                <td>{{ $lesson->title }}</td>

                <td>{{ $lesson->program->title ?? '' }}</td>

                <td>

                <a href="{{ route('lesson-plans.show',$lesson->id) }}"
                class="btn btn-info btn-sm">

                View

                </a>

                <a href="{{ route('lesson-plans.edit',$lesson->id) }}"
                class="btn btn-warning btn-sm">

                Edit

                </a>

                <form method="POST"
                    action="{{ route('lesson-plans.destroy',$lesson->id) }}"
                    style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                onclick="return confirm('Delete?')">

                Delete

                </button>

                </form>

                </td>

            </tr>

            @endforeach

        </table>

        {{ $lessons->links() }}

    </div>

@endsection