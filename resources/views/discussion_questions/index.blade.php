@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Discussion Questions for: {{ $lesson->podcast->title }} - Lesson {{ $lesson->id }}</h3>
        <a href="{{ route('discussion_questions.create', $lesson->id) }}" class="btn btn-primary">Add Question</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lesson->questions as $q)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $q->question }}</td>
                    <td>
                        <a href="{{ route('discussion_questions.edit',[$q->id,$lesson->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('discussion_questions.destroy', [$q->id,$lesson->id]) }}" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this question?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('podcast_lessons.index') }}" class="btn btn-secondary mt-2">Back to Lessons</a>

</div>
@endsection