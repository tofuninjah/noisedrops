<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    /**
     * Get backgrounds for our Drop.
     */
    public function backdrops()
    {
        return $this->hasMany('App\background');
    }

    /**
     * The tags that belong to the Drop.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
