<?php

namespace App\Http\Requests\Admin\Packet;

use Illuminate\Foundation\Http\FormRequest;

class PacketEditRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'with_venue' => 'required|numeric',
            'code' => 'required|string|unique:packets,code,' . $this->packet->id ?? null,
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'description' => 'required',
        ];
    }
}
