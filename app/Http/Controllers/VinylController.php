<?php

namespace App\Http\Controllers;

use App\Vinyl;
use App\Artist;
use App\Genre;
use App\Pochette;
use Illuminate\Http\Request;

class VinylController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vinyls = Vinyl::all();

        return view('vinyl.index', ['vinyls' => $vinyls]);
        // return $vinyls;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $pochettes = Pochette::all();

        return view('vinyl.create', [
            'artists' => $artists, 
            'genres' => $genres, 
            'pochettes' => $pochettes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vinyl = new Vinyl();
        $data = $this->validate($request, [
            'name'=>'required|max:100',
            'date'=>'required|date',
            'tracklist'=>'required|max:100',
            'format'=>'required|max:100',
            'artist_id'=>'required',
            'genre_id'=>'required',
        ]);
       
        $vinyl->saveVinyl($data);
        return redirect()->route('vinyls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vinyl  $vinyl
     * @return \Illuminate\Http\Response
     */
    public function show(Vinyl $vinyl)
    {
        return view('vinyl.show', ['vinyl' => $vinyl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vinyl  $vinyl
     * @return \Illuminate\Http\Response
     */
    public function edit(Vinyl $vinyl)
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $pochettes = Pochette::all();

        return view('vinyl.edit', [
            'artists'   => $artists, 
            'genres'    => $genres, 
            'pochettes' => $pochettes,
            'vinyl'     => $vinyl]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vinyl  $vinyl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vinyl $vinyl)
    {
        $data = $this->validate($request, [
            'name'=>'required|max:100',
            'date'=>'required|date',
            'tracklist'=>'required|max:100',
            'format'=>'required|max:100',
            'artist_id'=>'required',
            'genre_id'=>'required',
        ]);

        $vinyl->saveVinyl($data);
        return redirect()->route('vinyls.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vinyl  $vinyl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vinyl $vinyl)
    {
        $vinyl->delete();
        return redirect()->route('vinyls.index');
    }
}
