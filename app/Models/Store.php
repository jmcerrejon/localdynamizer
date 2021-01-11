<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Establecimientos';

    protected $appends = [
        'img_path'
    ];

    protected $fillable = [
        'user_id', 'service_id', 'location_id', 'category_id', 'payment_method_id', 'is_active', 'comercial_name',
        'business_name', 'cif', 'contact_name', 'address', 'postal_code', 'contact_phone', 'public_phone', 'whatsapp',
        'email', 'email_public', 'logo_path', 'website', 'description', 'facebook', 'instagram', 'twitter', 'tripadvisor',
        'tiktok', 'menu_es', 'menu', 'opening_hours'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'opening_hours' => 'array',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function getImgPathAttribute(): string
    {
        if (is_null($this->logo_path)) {
            return '';
        }

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

    public function invoices() : HasMany
    {
        return $this->HasMany(\App\Models\Invoice::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Service::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function activities() : BelongsToMany
    {
       return $this->belongsToMany(\App\Models\Activity::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('establecimientos.show', $this->id);

        return new SearchResult(
            $this,
            $this->comercial_name,
            $url
        );
    }
}
