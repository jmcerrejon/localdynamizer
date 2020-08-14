<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    public $fillable = [ 'user_id', 'mime_id', 'body', 'path', 'views', 'downloads' ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function mime() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Mime::class);
    }

    public function hashtags() : BelongsToMany
    {
       return $this->belongsToMany(\App\Models\Hashtag::class);
    }
}
