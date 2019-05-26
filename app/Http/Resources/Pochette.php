<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pochette extends JsonResource
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
            'image' => $this->image,
            'illustrator' => $this->illustrator,
            'vinyl_id' => $this->vinyl_id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
//        return parent::toArray($request);
    }
}
