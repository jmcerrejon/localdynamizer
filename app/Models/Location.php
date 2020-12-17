<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    public $timestamps = false;
    public $fillable = ['postal_code', 'dc', 'name', 'codauto'];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }
}
