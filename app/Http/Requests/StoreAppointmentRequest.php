<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_name'   => ['required', 'string', 'max:120'],
            'phone'          => ['required', 'string', 'max:30'],
            'email'          => ['nullable', 'email', 'max:120'],
            'department_id'  => ['required', 'exists:departments,id'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'reason'         => ['nullable', 'string', 'max:1000'],
        ];
    }
}