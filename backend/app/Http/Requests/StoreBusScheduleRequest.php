<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Return true if authorization is not required or implement custom logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'bus_id' => 'required|exists:buses,id', // Ensure bus exists in the buses table
            'start_from' => 'required|string',      // Required string for start location
            'date' => 'required|date',              // Required date field
            'total_tickets' => 'required|integer|min:1',  // Must be an integer and >= 1
            'ticket_sold' => 'required|integer|min:0',    // Must be an integer and >= 0
            'remaining_tickets' => 'required|integer|min:0', // Must be an integer and >= 0
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
            'total_tickets' => 'Total Tickets',
            'ticket_sold' => 'Tickets Sold',
            'remaining_tickets' => 'Remaining Tickets',
        ];
    }
}
