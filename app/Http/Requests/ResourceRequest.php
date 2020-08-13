<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            'mime_id' => ['required', 'numeric'],
            'body' => ['required', 'max:200'],
            'hashtags' => ['required'], // TODO Transform "first, second" on array of hashtags here: ['#first', '#second']
            'resource_file' => ['nullable', 'file'], // TODO If mime_id is != 1, 'required'
        ];
    }
}
