@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Edit Lesson</h3>

        <form method="POST"
        action="{{ route('lesson-plans.update',$lesson->id) }}"
        enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('lesson_plans.form')

            <button class="btn btn-primary">
            Update
            </button>

        </form>

    </div>

@endsection