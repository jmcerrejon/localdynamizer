<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'start_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'finish_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'comments' => ['nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'título',
            'start_time' => 'empieza',
            'finish_time' => 'termina',
            'comments' => 'comentarios',
        ];
    }
}
