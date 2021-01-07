<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityStore extends Model
{
    use HasFactory;

    public $table = 'activity_store';
    public $timestamps = false;
}
