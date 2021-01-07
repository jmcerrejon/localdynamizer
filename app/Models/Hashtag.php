<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Hashtag extends Model implements Searchable
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['name'];

    public function resources() : BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Resource::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('recursos.hashtags.search').'?q='.$this->name;

        return new SearchResult(
            $this,
            'Mostrar recursos que contengan: '.$this->name,
            $url
         );
    }
}
