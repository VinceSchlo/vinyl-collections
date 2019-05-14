<?php

use Illuminate\Http\Request;

// Artist API
use App\Artist;
use App\Http\Resources\ArtistCollection;
use App\Http\Resources\Artist as ArtistResource;

// Genre API
use App\Genre;
use App\Http\Resources\GenreCollection;
use App\Http\Resources\Genre as GenreResource;

// Vinyl API
use App\Vinyl;
use App\Http\Resources\VinylCollection;
use App\Http\Resources\Vinyl as VinylResource;


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
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new ArtistCollection(Artist::paginate());
});
Route::get('/artists/{id}', function ($id) {
    return new ArtistResource(Artist::find($id));
});

// Genre API
Route::get('/genres', function () {
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new GenreCollection(Genre::all());
});
Route::get('/genres/{id}', function ($id) {
    return new GenreResource(Genre::find($id));
});

// Vinyl API
Route::get('/vinyls', function () {
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new VinylCollection(Vinyl::all());
});
Route::get('/vinyls/{id}', function ($id) {
    return new VinylResource(Vinyl::find($id));
});
