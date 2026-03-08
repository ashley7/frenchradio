@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ isset($question) ? 'Edit Question' : 'Add Question' }}</h4>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ isset($question) ? route('discussion_questions.update', $question->id) : route('discussion_questions.store', $lesson->id) }}">
                @csrf
                @if(isset($question)) @method('PUT') @endif

                <div class="form-group">
                    <label>Question</label>
                    <textarea name="question" class="form-control" rows="3" required>{{ old('question', $question->question ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($question) ? 'Update Question' : 'Save Question' }}</button>
                <a href="{{ route('discussion_questions.index', $lesson->id ?? $question->podcast_lesson_id) }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</div>
@endsection