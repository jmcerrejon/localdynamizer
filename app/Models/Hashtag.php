<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    public $timestamps = false;

    public $fillable = ['name'];

    public function resources()
    {
        return $this->belongsToMany(\App\Models\Hashtag::class);
    }
}
