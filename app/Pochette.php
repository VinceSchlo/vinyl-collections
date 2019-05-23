<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pochette extends Model
{
    protected $table = 'pochettes';
    protected $fillable = ['illustrator', 'image'];

        /**
     * Get the vinyl that belong to the pochette.
     */
    public function vinyl()
    {
        return $this->belongsTo('App\Vinyl');
    }
}
