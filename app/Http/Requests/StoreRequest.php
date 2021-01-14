<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Basic
            'is_active' => ['required'],
            'service_id' => ['required', 'numeric'],
            'commercial_name' => ['required', 'max:100'],
            'business_name' => ['nullable', 'max:100'],
            'cif' => ['required', 'max:9'],
            'contact_name' => ['required', 'max:100'],
            'category_id' => ['required', 'numeric'],
            'taggles' => ['required', 'array'],
            'address' => ['required', 'max:191'],
            'postal_code' => ['required', 'max:5'],
            'email' => ['required', 'email', 'max:50'],
            'email_public' => ['nullable', 'email', 'max:50'],
            'contact_phone' => ['required', 'digits_between:9,15'],
            'public_phone' => ['nullable', 'digits_between:9,15'],
            'whatsapp' => ['nullable', 'digits_between:9,15'],
            'logo_file' => ['nullable', 'image', 'dimensions:max_width=2048,max_height=1024'],
            // Premium
            'payment_method_id' => ['nullable','numeric'],
            'slogan' => ['nullable', 'max:100'],
            'description' => ['nullable'],
            'website' => ['nullable', 'url', 'max:100'],
            'facebook' => ['nullable', 'max:50'],
            'instagram' => ['nullable', 'max:50'],
            'twitter' => ['nullable', 'max:50'],
            'tripadvisor' => ['nullable', 'max:50'],
            'tiktok' => ['nullable', 'max:50'],
            'menu_es' => ['nullable', 'url', 'max:100'],
            'menu' => ['nullable', 'url', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_method_id' => 'método de pago',
            'service_id' => 'servicio contratado',
            'category_id' => 'categoría',
            'taggles' => 'actividad',
            'commercial_name' => 'nombre comercial',
            'cif' => 'CIF',
            'contact_name' => 'persona de contacto',
            'address' => 'dirección del establecimiento',
            'postal_code' => 'código postal',
            'email' => 'correo electrónico',
            'contact_phone' => 'teléfono de contacto',
        ];
    }
}