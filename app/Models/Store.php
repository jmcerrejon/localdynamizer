<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $casts = [
		'created_at' => 'datetime:d/m/Y H:i',
		'updated_at' => 'datetime:d/m/Y H:i',
    ];

    protected $appends = [
		'img_path'
	];

    protected $fillable = [
        'user_id', 'payment_method_id', 'comercial_name', 'business_name', 'cif', 'is_active', 'contact_name', 'address', 'locality', 'population', 'postal_code', 'email', 'public_phone', 'contact_phone', 'whatsapp', 'website', 'subscription_type', 'logo_path'
    ];

	protected $dates = [
		'created_at', 'updated_at'
    ];
    
    public function getImgPathAttribute()
	{
        if (strpos($this->logo_path, 'https') !== false) {
            return $this->logo_path;
        }

		return config('app.url').'storage/'.$this->logo_path;
	}

    public function actives()
	{
		return $this->where('is_active', 1)->get();
	}

	public function setIsActiveAttribute($value)
	{
		$this->attributes['is_active'] = ($value === "on") ? 1 : 0;
    }
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
