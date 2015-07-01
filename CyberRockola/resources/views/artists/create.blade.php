@extends('app')
@section('content')
    <h1>Create Artists</h1>
    {!! Form::open(['url' => 'artists']) !!}
    <div class="form-group">
        {!! Form::label('artist', 'Artists Name:') !!}
        {!! Form::text('artist',null,['class'=>'form-control']) !!}
    </div>    
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop
