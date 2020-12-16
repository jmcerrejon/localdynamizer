<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $model = User::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone1', 'password', 'is_enabled', 'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function locations() : BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Location::class);
    }

    public function stores() : HasMany
    {
        return $this->HasMany(\App\Models\Store::class);
    }
    public function resources() : HasMany
    {
        return $this->HasMany(\App\Models\Resource::class);
    }
}
