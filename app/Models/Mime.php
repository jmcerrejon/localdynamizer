<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mime extends Model
{
    public $timestamps = false;

    public function resources() : HasMany
    {
        return $this->HasMany(\App\Models\Resource::class);
    }
}
