<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    public function invoiceitems() : HasMany
    {
        return $this->HasMany(\App\Models\Invoiceitem::class);
    }

    public function store() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }
}
