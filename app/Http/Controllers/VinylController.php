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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name'=>'required|max:100',
            'date'=>'required|date',
            'tracklist'=>'required|max:100',
            'format'=>'required|max:100',
            'artist_id'=>'required',
            'genre_id'=>'required',
            'illustrator'=>'required|max:100',
        ]);

        $image = $request->file->store('pochettes');

        $pochette = new Pochette();
        $pochette->image = $image;
        $pochette->illustrator = $data['illustrator'];
//        $pochette->save();


        $vinyl = new Vinyl();
        $vinyl->saveVinyl($data, $pochette);
        return response()->json("created", 201);
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
            'pochette_id'=>'required',
        ]);

        $vinyl->saveVinyl($data);
        return response()->json($request, 200);
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
        return response()->json("Deleted", 200);
    }
}
