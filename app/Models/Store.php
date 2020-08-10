<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $casts = [
		'created_at' => 'datetime:d/m/Y H:i',
		'updated_at' => 'datetime:d/m/Y H:i',
		'is_active'	 => 'boolean'
    ];

    protected $fillable = [
        'name', 'active', 'url', 'img_file'
    ];

	protected $dates = [
		'created_at', 'updated_at'
	];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function actives()
	{
		return $this->where('is_active', 1)->get();
	}

	public function setActiveAttribute($value)
	{
		$this->attributes['active'] = ($value === "on") ? 1 : 0;
	}
}
