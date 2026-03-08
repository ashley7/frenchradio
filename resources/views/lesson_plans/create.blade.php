@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Create Lesson</h3>

        <form method="POST"
            action="{{ route('lesson-plans.store') }}"
            enctype="multipart/form-data">

            @csrf

            @include('lesson_plans.form')

            <button class="btn btn-success">
            Save
            </button>

        </form>

    </div>

@endsection