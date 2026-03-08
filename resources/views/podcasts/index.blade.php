@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4 class="mb-0">Podcasts</h4>

            <a href="{{ route('podcasts.create') }}"
               class="btn btn-primary">

                Add Podcast

            </a>

        </div>


        <div class="card-body">


            <table class="table table-bordered table-striped">

                <thead class="thead-dark">

                <tr>

                    <th>#</th>
                    <th>Title</th>
                    <th>Media</th>
                    <th width="200">Action</th>

                </tr>

                </thead>

                <tbody>

                @foreach($podcasts as $p)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            <strong>

                                {{ $p->title }}

                            </strong>

                        </td>


                        <td>

                            @if($p->audio_file) Audio @endif

                            @if($p->you_tube_embed_url) Video @endif

                        </td>


                        <td>

                            <a href="{{ route('podcasts.show',$p->id) }}"
                               class="btn btn-sm btn-primary">

                                View

                            </a>

                            <a href="{{ route('podcasts.edit',$p->id) }}"
                               class="btn btn-sm btn-warning">

                                Edit

                            </a>


                            <form method="POST"
                                  action="{{ route('podcasts.destroy',$p->id) }}"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this podcast?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>


        </div>

    </div>

</div>

@endsection