<?php

use Illuminate\Http\Request;

// Artist API
use App\Artist;
use App\Http\Resources\ArtistCollection;
use App\Http\Resources\Artist as ArtistRessource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Artist API
Route::get('/artists', function () {
    return ArtistRessource::collection(Artist::all()->keyBy->id);
});
