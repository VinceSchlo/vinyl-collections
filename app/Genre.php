<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    /**
     * Get the vinyls for the genre.
     */
    public function vinyls()
    {
        return $this->hasMany('App\Vinyl');
    }

    public function saveGenre($data)
    {
        $this->name = $data['name'];
        $this->save();
    }
}
