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
        return $this->HasMany(\App\Models\Invoiceitem::class);
    }
    
    public function store() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    /**
     * Get invoice by id with items and store
     *
     * @param  Int  $id
     * @return Object
     */
    public function getInvoiceByIdWithItemsAndStore($id)
    {
        return $this->with('invoiceitems', 'store')->findOrFail($id);
    }
}
