<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backdrop extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function drop()
    {
        return $this->belongsTo('App\Drop');
    }
}
