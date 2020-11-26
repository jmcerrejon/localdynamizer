<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model implements Searchable
{
    use HasFactory;

    protected $model = Appointment::class;

    public $searchableType = 'Citas';

    public $fillable = ['title', 'start_time', 'finish_time', 'comments'];

    public function getSearchResult(): SearchResult
    {
        $url = route('appointment.edit', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url
         );
    }
}
