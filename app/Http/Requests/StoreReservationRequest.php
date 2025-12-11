<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'time_start.date_format' => 'Waktu mulai harus dalam format HH:MM (24 jam).',
            'time_end.date_format' => 'Waktu selesai harus dalam format HH:MM (24 jam).',
        ];
    }
}
