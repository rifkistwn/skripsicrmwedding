<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionEditRequest extends FormRequest
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
            'title.*' => 'nullable|unique:events,title',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.*.unique' => 'Title must be unique.',
        ];
    }
}
