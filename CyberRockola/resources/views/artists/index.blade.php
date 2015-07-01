@extends('app')

@section('content')
    <h1>Artists</h1>

@if (Auth::user()->is_admin == '1')
    <a class="btn btn-primary btn-lg" href="{{ url('artists/create') }}"
       role="button">Create Artist</a>
@endif

    <table class="table table-hover" id="tableIndex">
    <thead>
        <tr>            
            <th>Artists</th>
            <th>Options</th>
        </tr>
    </thead>


    @foreach($artists as $artist)
    
    <tr>
        <td>{!! $artist->name !!}</td>           
        
        <td>
        @if (Auth::user()->is_admin == '1')
            <div class="col-xs-2" >
                <a href="/artists/{{{$artist->id}}}/edit" class="btn btn-warning form-control" role="button">Edit</a>
            </div>
            <div class="col-xs-2" >
                {!!Form::open(array('url' => "/artists/$artist->id", 'method' => 'DELETE'))!!}                
                       <button class="btn btn-danger form-control" role="button">Delete</button>
                {!!Form::close()!!} 
            </div>  
        @endif      
        </td>
    </tr>
    @endforeach

    </table>

    {!! $artists->render() !!}
    
@stop
