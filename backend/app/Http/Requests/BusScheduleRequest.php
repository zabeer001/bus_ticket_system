<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusScheduleRequest extends FormRequest
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
            'bus_id' => 'required|integer|exists:buses,id',
            'start_from' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'total_tickets' => 'required|integer|min:1',
            'ticket_sold' => 'required|integer|min:0',
            'remaining_tickets' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'bus_id' => 'Bus',
            'start_from' => 'Start Location',
            'date' => 'Schedule Date',
            'time' => 'Schedule Time',
            'total_tickets' => 'Total Tickets',
            'ticket_sold' => 'Tickets Sold',
            'price' => 'Bus ticket price', // Corrected label for price
        ];
    }
}
