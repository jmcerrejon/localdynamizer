<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hashtag extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['name'];

    public function resources()
    {
        return $this->belongsToMany(\App\Models\Hashtag::class);
    }
}
