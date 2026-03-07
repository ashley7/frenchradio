@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Create Radio Program</h3>

    <form method="POST" 
          action="{{ route('radio-programs.store') }}" 
          enctype="multipart/form-data">

        @csrf

        @include('radio_programs.form')

        <button class="btn btn-success">
            Save Program
        </button>

    </form>

</div>

@endsection