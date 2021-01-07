<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    public $timestamps = false;
    public $fillable = ['postal_code', 'dc', 'name', 'codauto', 'active'];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function stores() : HasMany
    {
        return $this->hasMany('App\Models\Store');
    }
}
