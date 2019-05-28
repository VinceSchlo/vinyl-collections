<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Artist API
use App\Artist;
use App\Http\Resources\Artist as ArtistResource;

// Genre API
use App\Genre;
use App\Http\Resources\Genre as GenreResource;

// Pochette API
use App\Pochette;
use App\Http\Resources\Pochette as PochetteResource;

use GuzzleHttp\Client;

class Vinyl extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = new Client([
            'base_uri' => 'https://api.discogs.com',
        ]);
        $response = $client->request('GET', '/masters/' . $this->tracklist);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'tracklist' => json_decode($response->getBody()->getContents())->tracklist,
            'format' => $this->format,
            'date' => $this->date,
            'artist' => new ArtistResource(Artist::find($this->artist_id)),
            'genre' => new GenreResource(Genre::find($this->genre_id)),
            'pochette' => new PochetteResource(Pochette::find($this->pochette_id)),
             'created_at' => $this->created_at,
             'updated_at' => $this->updated_at,
        ];
    }
}
