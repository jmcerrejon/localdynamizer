<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    public function invoiceitems() : HasMany
    {
        return $this->HasMany(\App\Models\Invoiceitem::class);
    }
}
