@extends('app')

@section('content')
    <h1>Tracks</h1>

@if (Auth::user()->is_admin == '1')
    <a class="btn btn-primary btn-lg" href="{{ url('tracks/create') }}"
       role="button">Add New Track</a>
@endif
    <table class="table table-hover" id="tableIndex">
    <thead>
        <tr>
            <th>Track Name</th>
            <th>Artists Name</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>

    @foreach($tracks as $track)
    
    <tr>
        <td>{!! $track->name !!}</td>       
        
        <td>

            @foreach($artists as $artist)
                <?php  
                    if($artist->id == $track->id_artist)
                    {
                ?>

                    {!! $artist->name !!}
                    
                <?php 
                    }
                ?>
            @endforeach

        </td>        
        
        <td>
        @if (Auth::user()->is_admin == '1')
            <div class="col-xs-2" >
                <a href="/tracks/{{{$track->id}}}/edit" class="btn btn-warning form-control" role="button">Edit</a>
            </div>
            <div class="col-xs-2" >
                {!!Form::open(array('url' => "/tracks/$track->id", 'method' => 'DELETE'))!!}                
                       <button class="btn btn-danger form-control" role="button">Delete</button>
                {!!Form::close()!!} 
            </div> 
        @endif     
            <div class="col-xs-2" >
                <a href="/tracks/{{{$track->id}}}/add_queue" class="btn btn-success" role="button">Add Queue</a>
            </div>  
        </td>
    </tr>
    @endforeach

        </tbody>

    </table>

    {!! $tracks->render() !!}
    
@stop
    