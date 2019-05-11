<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    protected $fillable = ['name'];

    /**
     * Get the vinyls for the artist.
     */
    public function vinyls()
    {
        return $this->hasMany('App\Vinyl');
    }

    public function saveArtist($data)
    {
        $this->name = $data['name'];
        $this->save();
    }
}
