<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    protected $fillable = ['name'];

    public function saveArtist($data)
    {
        $this->name = $data['name'];
        $this->save();
    }
}
