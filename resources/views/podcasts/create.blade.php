@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Podcast</h4>
        </div>

        <div class="card-body">

            {{-- Display validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('podcasts.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           placeholder="Enter podcast title"
                           required>
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea name="description"
                              id="description"
                              class="form-control"
                              rows="4"
                              placeholder="Enter description"
                              required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="audio_file">Audio File</label>
                    <input type="file"
                           name="audio_file"
                           id="audio_file"
                           class="form-control-file">
                    <small class="form-text text-muted">
                        Supported formats: mp3, wav, ogg.
                    </small>
                </div>

                <div class="form-group">
                    <label for="you_tube_embed_url">YouTube Embed URL</label>
                    <input type="text"
                           name="you_tube_embed_url"
                           id="you_tube_embed_url"
                           class="form-control"
                           value="{{ old('you_tube_embed_url') }}"
                           placeholder="Enter YouTube embed URL">
                </div>

                <hr>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Podcast
                </button>

                <a href="{{ route('podcasts.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection