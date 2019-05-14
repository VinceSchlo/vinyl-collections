<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Artist API
use App\Artist;
use App\Http\Resources\Artist as ArtistResource;

// Genre API
use App\Genre;
use App\Http\Resources\Genre as GenreResource;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tracklist' => $this->tracklist,
            'format' => $this->format,
            'date' => $this->date,
            'artist' => new ArtistResource(Artist::find($this->artist_id)),
            'genre' => new GenreResource(Genre::find($this->genre_id)),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
        // return parent::toArray($request);
    }
}
