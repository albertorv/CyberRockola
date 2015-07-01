@extends('app')

@section('content')
        <article>
            <h1>{{ $track->name }}</h1>
            <div class="body">
                {{ $track->dir_track }}
            </div>
        </article>
@stop
