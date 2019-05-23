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

// User API
use App\User;
// use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;


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

// Ressources
Route::resource('artists'  , 'ArtistController'  )->only(['store', 'update', 'destroy']);
Route::resource('genres'   , 'GenreController'   )->only(['store', 'update', 'destroy']);
Route::resource('pochettes', 'PochetteController')->only(['store', 'update', 'destroy']);
Route::resource('vinyls'   , 'VinylController'   )->only(['store', 'update', 'destroy']);
Route::resource('users'    , 'UserController'    )->only(['store', 'update', 'destroy']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Artist API
Route::get('/artists', function () {
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new ArtistCollection(Artist::paginate());
});
Route::get('/artists/{artist}', function (Artist $artist) {
    return new ArtistResource($artist);
})->name('artist.show');

// Genre API
Route::get('/genres', function () {
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new GenreCollection(Genre::all());
});
Route::get('/genres/{genre}', function (Genre $genre) {
    return new GenreResource($genre);
});

// Vinyl API
Route::get('/vinyls', function () {
    // return ArtistRessource::collection(Artist::all()->keyBy->id);
    return new VinylCollection(Vinyl::all());
});
Route::get('/vinyls/{vinyl}', function (Vinyl $vinyl) {
    return new VinylResource($vinyl);
});

// Collection API
Route::get('/collections/{id}', function ($id) {
    return new UserResource(User::find($id));
});
