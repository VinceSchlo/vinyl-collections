<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pochette extends Model
{
    protected $table = 'pochettes';

        /**
     * Get the user that owns the phone.
     */
    public function vinyl()
    {
        return $this->belongsTo('App\Vinyl');
    }
}
