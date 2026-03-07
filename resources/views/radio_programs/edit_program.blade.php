@extends('layouts.app')

@section('content')

<div class="container">

<h3>Edit Radio Program</h3>

<form method="POST"
      action="{{ route('radio-programs.update',$program->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('radio_programs.form')

    <button class="btn btn-primary">
        Update Program
    </button>

</form>

</div>

@endsection