<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    public function users() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }
}
