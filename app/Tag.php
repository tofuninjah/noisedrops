<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The drops that belong to the tag.
     */
    public function drops()
    {
        return $this->belongsToMany('App\Drop');
    }
}
