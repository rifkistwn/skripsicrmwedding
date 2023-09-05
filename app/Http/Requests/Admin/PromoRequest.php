<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
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
            'packet_id' => 'required|exists:packets,id',
            'venue_id' => 'nullable',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:start_date',
            'discount' => 'required|numeric',
            'max_discount' => 'required|numeric',
            'code' => 'required|string|unique:promos,code,' . $this->promo ?? null
        ];
    }
}
