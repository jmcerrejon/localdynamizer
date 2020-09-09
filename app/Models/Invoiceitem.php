<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoiceitem extends Model
{
    use HasFactory;

    public $timestamps = false;

    function invoice() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Invoice::class);
    }
}
