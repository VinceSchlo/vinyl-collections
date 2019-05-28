<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Vinyl API
// use App\Vinyl;
// use App\Http\Resources\Vinyl as VinylResource;

class User extends JsonResource
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
            'email' => $this->email,
            'collection' => Vinyl::collection($this->vinyls),
        ];
    }
}
