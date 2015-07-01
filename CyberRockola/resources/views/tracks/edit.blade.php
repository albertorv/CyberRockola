@extends('app')

@section('content')
    <h1>Editing: Track Info</h1>
    <hr>

    {!! Form::model($track, ['method'=>'PATCH', 'action' => ['TracksController@update', $track->id]]) !!}
        
        





	<input name="name" value="{{{$track->name}}}" >
    <select name="id_artist">
	@foreach($artists as $artist)
		<?php
			if($artist->id==$track->id_artist){
				echo "<option selected value= $artist->id>$artist->name</option>";
			}else{
				echo "<option  value= $artist->id>$artist->name</option>";
			}
		?>
	@endforeach
    </select>





        <div class="form-group">
            {!! Form::submit('Editar Cancion', ['class'=>'btn btn-primary form-control'])  !!}
        </div>
    {!! Form::close() !!}

@stop

