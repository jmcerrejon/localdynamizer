<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'start_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'finish_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'comments' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'título',
            'start_time' => 'empieza',
            'finish_time' => 'termina',
            'comments' => 'comentarios',
        ];
    }
}
