<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function mime() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Mime::class);
    }

    public function hashtags()
    {
       return $this->belongsToMany(\App\Models\Hashtag::class);
    }
}
