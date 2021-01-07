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
            'payment_method_id' => ['required', 'numeric'],
            'service_id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'comercial_name' => ['required', 'max:100'],
            'business_name' => ['max:100'],
            'cif' => ['required', 'max:9'],
            'is_active' => ['required'],
            'contact_name' => ['required', 'max:100'],
            'address' => ['required', 'max:191'],
            'locality' => ['max:150'],
            'population' => ['max:150'],
            'postal_code' => ['required', 'max:5'],
            'email' => ['required', 'email', 'max:50'],
            'public_phone' => ['nullable', 'digits_between:9,15'],
            'contact_phone' => ['required', 'digits_between:9,15'],
            'whatsapp' => ['nullable', 'digits_between:9,15'],
            'website' => ['nullable', 'url', 'max:100'],
            'subscription_type' => ['required', 'numeric'],
            'logo_file' => ['nullable', 'image', 'dimensions:max_width=2048,max_height=1024'],
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_method_id' => 'método de pago',
            'service_id' => 'servicio contratado',
            'category_id' => 'categoría',
            'comercial_name' => 'nombre comercial',
            'cif' => 'CIF',
            'contact_name' => 'persona de contacto',
            'address' => 'dirección del establecimiento',
            'postal_code' => 'código postal',
            'email' => 'correo electrónico',
            'contact_phone' => 'teléfono de contacto',
        ];
    }
}