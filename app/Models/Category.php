<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false;

    public function stores() : HasMany
    {
        return $this->hasMany('App\Models\Store');
    }
}
