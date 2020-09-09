<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HashtagResource extends Model
{
    use HasFactory;

    public $table = 'hashtag_resource';
    public $timestamps = false;
}
