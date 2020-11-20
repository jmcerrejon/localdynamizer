<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'title' => ['required'],
            'start_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'finish_time' => ['required', 'date_format:Y-m-d\TH:i'],
            'comments' => ['nullable'],
        ];
    }
}
