<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoiceitem extends Model
{
    public $timestamps = false;

    function invoice() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Invoice::class);
    }
}
