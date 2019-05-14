<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vinyl extends Model
{
    protected $table = 'vinyls';
    protected $fillable = ['name', 'tracklist', 'format', 'date', 'genre_id', 'artist_id', 'pochette_id'];

    /**
     * Get the pochette associated with the vinyl.
     */
    public function pochette()
    {
        return $this->hasOne('App\Pochette');
    }

    /**
     * Get the artist of the vinyl.
     */
    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    /**
     * Get the genre of the vinyl.
     */
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    /**
     * The users that own the vinyl.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'vinyls_users');
    }

    public function saveVinyl($data)
    {
        $this->name        = $data['name'];
        $this->date        = $data['date'];
        $this->tracklist   = $data['tracklist'];
        $this->format      = $data['format'];
        $this->artist_id   = $data['artist_id'];
        $this->genre_id    = $data['genre_id'];
        // $this->pochette_id = $data['pochette_id'];
        $this->save();
    }
}
