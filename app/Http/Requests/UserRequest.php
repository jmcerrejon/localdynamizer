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
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['password' => 'required|min:6'];
        }

        return $rules;
    }
}
