<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mime_id' => ['required', 'numeric'],
            'body' => ['required', 'max:200'],
            'hashtags' => ['required'], // TODO Transform "first, second" on array of hashtags here: ['#first', '#second']
            'resource_file' => ['nullable', 'file'], // TODO If mime_id is != 1, 'required'
        ];
    }

    public function attributes()
    {
        return [
            'mime_id' => 'tipo de recurso',
            'body' => 'mensaje/descripción',
            'resource_file' => 'recurso multimedia',
        ];
    }
}
