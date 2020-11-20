<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $model = Appointment::class;

    public $fillable = ['title', 'start_time', 'finish_time', 'comments'];
}
