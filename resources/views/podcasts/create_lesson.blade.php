@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ isset($lesson) ? 'Edit Lesson' : 'Add Lesson' }}</h4>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ isset($lesson) ? route('podcast_lessons.update', $lesson->id) : route('podcast_lessons.store') }}">
                @csrf
                @if(isset($lesson)) @method('PUT') @endif

                <div class="form-group">
                    <label for="podcast_id">Podcast <span class="text-danger">*</span></label>
                    <select name="podcast_id" class="form-control" required>
                        <option value="">-- Select Podcast --</option>
                        @foreach($podcasts as $podcast)
                            <option value="{{ $podcast->id }}" {{ (isset($lesson) && $lesson->podcast_id==$podcast->id) ? 'selected' : '' }}>
                                {{ $podcast->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Key Themes</label>
                    <textarea name="key_themes" class="form-control" rows="3" required>{{ old('key_themes', $lesson->key_themes ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Learning Outcomes</label>
                    <textarea name="learning_outcomes" class="form-control" rows="3" required>{{ old('learning_outcomes', $lesson->learning_outcomes ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Practical Applications</label>
                    <textarea name="practical_applications" class="form-control" rows="3" required>{{ old('practical_applications', $lesson->practical_applications ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($lesson) ? 'Update Lesson' : 'Save Lesson' }}</button>
                <a href="{{ route('podcast_lessons.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</div>
@endsection