<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            // 'email' => ['required', 'unique:email'], TODO Uncomment when table user become dynamizer
            'phone1' => ['required', 'string'],
        ];

        // if ($this->getMethod() == 'POST') {
        //     $rules += ['password' => 'required', 'min:6]'];
        // }

        return $rules;
    }
}
