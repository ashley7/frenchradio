@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Podcast Lessons</h3>
        <a href="{{ route('podcast_lessons.create') }}" class="btn btn-primary">Add Lesson</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Podcast</th>
                <th>Key Themes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lesson->podcast->title }}</td>
                    <td>{{ Str::limit($lesson->key_themes, 50) }}</td>
                    <td>
                        <a href="{{ route('podcast_lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('discussion_questions.index', $lesson->id) }}" class="btn btn-sm btn-info">Questions</a>
                        <form method="POST" action="{{ route('podcast_lessons.destroy', $lesson->id) }}" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this lesson?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection