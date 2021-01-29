<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo};

class Invoice extends Model
{
    use HasFactory;

    public function invoiceitems() : HasMany
    {
        return $this->hasMany(\App\Models\Invoiceitem::class);
    }

    public function store() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function getInvoiceByIdWithItemsAndStore(int $id)
    {
        return $this->with('invoiceitems', 'store')->findOrFail($id);
    }
}
