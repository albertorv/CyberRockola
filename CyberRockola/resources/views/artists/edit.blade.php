@extends('app')

@section('content')
    <h1>Editing: {!! $artist->name  !!}</h1>
    <hr>

    {!! Form::model($artist, ['method'=>'PATCH', 'action' => ['ArtistsController@update', $artist->id]]) !!}
        <input name="name" value="{{{$artist->name}}}" >        
        <div class="form-group">
            {!! Form::submit('Edit Artist', ['class'=>'btn btn-primary form-control'])  !!}
        </div>
    {!! Form::close() !!}

@stop
