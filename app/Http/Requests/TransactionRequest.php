<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'venue_id' => 'required|exists:venues,id',
            'promo_id' => 'nullable|exists:promos,id',
            'review_id' => 'nullable|exists:reviews,id',
            'datetime' => 'required|date',
            'title' => 'nullable|unique:events,title',
        ];
    }
}
