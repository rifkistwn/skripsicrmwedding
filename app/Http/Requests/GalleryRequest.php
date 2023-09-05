<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'event_id' => 'required|exists:events,id',
            'image.*' => 'mimes:png,jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.*.mimes' => 'File must be a file of type: png, jpeg, jpg.',
            'image.*.max' => 'File must be lower than 2MB.',
        ];
    }
}
