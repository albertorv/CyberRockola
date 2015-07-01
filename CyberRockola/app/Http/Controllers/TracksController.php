<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Artist;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTrackRequest;
use Carbon\Carbon;
use Input;

class TracksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Recuperar todos los articulos
        $tracks = Track::all();
        $artists = Artist::all();
        $tracks = Track::paginate(15);

        return view('tracks.index',compact('tracks','artists' )); //compact hace un arreglo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $artists = Artist::get()->all();                    
        //$tracks = Track::get()->all();
        return view('tracks.create',compact('tracks','artists' )); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $track = Track::all();
        $track = new Track();  

        $artist = Artist::all();
        $artist = new Artist();

        $id_artist = Input::get('id_artist');
        $track_name = Input::get('name');

        $track->id_artist = $id_artist;    
        $track->name = $track_name;

        $archivo = array('file' => Input::file('file'));
        //$extension = Input::file('file')->getClientOriginalExtension(); 
        $file_name =  Input::file('file')->getClientOriginalName();// 

        $new_name = $this->replace_white_spaces($file_name); //ejecuta el metodo para caracteres especiales
        $dir_file="/home/jona/Proyecto_Beto/CyberRockola/CyberRockola/uploads/rockola_music/"; //dirección fisica de las canciones
        Input::file('file')->move($dir_file, $new_name);//mueve con el nombre nuevo

        $track->dir_track = $dir_file . $new_name;//dirección exacta con el nombre de la cancion y extension
        $track->save();        

        return redirect('tracks');
    }

    /**public function storeOld(Request $request)
    {

    $rules =
        [
            'name' => 'required|min:3',
            'dir_track' => 'required'
        ];

        $this->validate($request,$rules);
        Track::create($request->all());
        
        return redirect('tracks');
    }**/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $track = Track::find($id);
        return view('tracks.show',compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $track = Track::find($id);
        $artists = Artist::all();

        return view('tracks.edit', compact('track','artists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
           $name = Input::get('name');
           $id_artist = Input::get('id_artist');

           $track=Track::find($id);
           $track->id_artist = $id_artist;
           $track->name = $name;
           $track->save();

           return redirect('tracks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Track::find($id)->delete();
        return redirect('tracks');
    }
/**
*Método para remplazar los caracteres especiales
**/
    public function replace_white_spaces($file){
        
        $file = strtolower($file);
        $file = preg_replace("/[^.a-z0-9_\s-]/", "", $file);
        $file = preg_replace("/[\s-]+/", " ", $file);
        $file = preg_replace("/[\s_]/", "_", $file);// agrega un _ en lugar de un espacio en blanco
        return $file;
    }   

    /**
    *Método 
    **/
    public function add_queue($id)
    {
        $track = Track::find($id);
        $dir_track=$track->dir_track;

        $this->queue($dir_track);
        return Redirect::to('tracks');                   
    }                
    /**
    *
    **/
    public function queue($queue){

        $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('rockola', false, false, false, false);
       
        $msg = new AMQPMessage($queue);
        $channel->basic_publish($msg, '', 'rockola');

        $channel->close();
        $connection->close();
        return Redirect::to('tracks');
    }
}