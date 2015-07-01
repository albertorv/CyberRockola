<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $artists = Artist::get()->all();        
        $artists = Artist::paginate(15);
        return view('artists.index',compact('artists')); //compact hace un arreglo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $artist = new Artist();
        $artist_name = Input::get('artist');  
        $artist->name = $artist_name;                      
        $artist->save();
        return redirect('artists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $artist = Artist::find($id);
        return view('artists.show',compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $artist = Artist::find($id);
        return view('artists.edit',compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
           $artist_name = Input::get('name');
           $artist=Artist::find($id);
           $artist->name = $artist_name;
           $artist->save();
           return redirect('artists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Artist::find($id)->delete();
        return redirect('artists');
    }
}
