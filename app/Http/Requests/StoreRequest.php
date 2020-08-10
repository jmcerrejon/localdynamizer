<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method_id' => ['required', 'numeric'],
            'comercial_name' => ['required', 'max:100'],
            'business_name' => ['max:100'],
            'is_active' => ['required'],
            'contact_name' => ['required', 'max:100'],
            'address' => ['required', 'max:191'],
            'locality' => ['max:150'],
            'population' => ['max:150'],
            'postal_code' => ['required', 'max:5'],
            'email' => ['required', 'email', 'max:50'],
            'public_phone' => ['digits_between:9,15'],
            'contact_phone' => ['required', 'digits_between:9,15'],
            'whatsapp' => ['digits_between:9,15'],
            'website' => ['url', 'max:100'],
            'subscription_type' => ['required', 'numeric'],
            'logo_file' => ['image', 'dimensions:max_width=2048,max_height=1024'],
        ];
    }
}