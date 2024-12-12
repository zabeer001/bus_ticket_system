<?php

namespace App\Http\Controllers\Api\Backend\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ShowTicketController extends Controller
{
    /**
     * Handle the incoming request to show a ticket.
     */
    public function __invoke(Request $request, $id)
    {
        try {
            // Find the ticket by ID
            $ticket = Ticket::findOrFail($id);

            // Return the ticket with a 200 status
            return $this->responseSuccess($ticket, 'Ticket retrieved successfully', 200);
        } catch (ModelNotFoundException $e) {
            // Return error response if ticket is not found
            return $this->responseError('Ticket not found', null, 404);
        } catch (\Exception $e) {
            // Log the error with additional context
            Log::error('Error retrieving ticket: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);

            // Return a generic error response
            return $this->responseError('Something went wrong', $e->getMessage(), 500);
        }
    }
}
