<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = new Artist();
        $data = $this->validate($request, [
            'name'=>'required|unique:artists|max:100',
        ]);

        $artist->saveArtist($data);

        return response()->json("created", 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $data = $this->validate($request, [
            'name'=>'required|unique:artists|max:100',
        ]);
        
        $artist->saveArtist($data);

        return response()->json($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json($artist, 200);
    }
}
