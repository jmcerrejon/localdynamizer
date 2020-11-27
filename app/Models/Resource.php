<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Resource extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Recursos';

    public $fillable = [ 'title', 'published', 'user_id', 'mime_id', 'body', 'path', 'views', 'downloads' ];

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = ($value === "on") ? 1 : 0;
    }

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

    public function getSearchResult(): SearchResult
    {
        $url = route('recursos.show', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
         );
    }
}
