<?php

namespace App\Http\Controllers;

use App\Pochette;
use Illuminate\Http\Request;

class PochetteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'illustrator'=>'required|max:100',
        ]);


        $image = $request->file->store('pochettes');

        $pochette = new Pochette();
        $pochette->image = $image;
        $pochette->illustrator = $data['illustrator'];
        $pochette->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pochette  $pochette
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pochette $pochette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pochette  $pochette
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pochette $pochette)
    {
        //
    }
}
