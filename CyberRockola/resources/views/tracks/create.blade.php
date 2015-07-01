@extends('app')
@section('content')
    <h1>Add New Song</h1>
    {!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true)) !!}

    <div class="form-group">
        {!! Form::label('name','Song Name: ')  !!}
        {!! Form::text('name', null , ['class'=>'form-control'])  !!}
    </div>

    <select name="id_artist">
        @foreach($artists as $artist)
            <option value={{$artist->id}}>{{$artist->name}}</option>
        @endforeach
    </select>   

    {!! Form::file('file', array('class'=>'file','id'=>'input-1', 'type'=>'file')) !!}
    <p class="errors">{!!$errors->first('file')!!}</p>
    <div id="success"> </div>
    {!! Form::submit('Submit', array('class'=>'send-btn')) !!}
    {!! Form::close() !!}


@stop



