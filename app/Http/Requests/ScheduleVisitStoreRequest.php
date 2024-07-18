<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleVisitStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'visit_date' => 'required|date|after:now|date_format:d-m-Y H:i|minute:00,30',
        ];
    }

    public function messages():array
    {
        return [
            'minute'=>"The minutes must be 00 or 30" ,
        ];
    }
}
