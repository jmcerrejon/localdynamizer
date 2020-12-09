<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    public function stores(): HasMany
    {
        return $this->HasMany(\App\Models\Store::class);
    }
}
