<?php

namespace App\Http\Controllers\Api\Backend\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class DeleteTicketController extends Controller
{
    /**
     * Handle the incoming request to delete a ticket.
     */
    public function __invoke(Request $request, $id)
    {
        try {
            // Ensure the user is an admin
            $this->isAdmin();

            // Find the ticket by ID
            $ticket = Ticket::findOrFail($id);

            // Delete the ticket
            $ticket->delete();

            // Return success response
            return $this->responseSuccess(null, 'Ticket deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            // Return error response if ticket is not found
            return $this->responseError('Ticket not found', null, 404);
        } catch (\Exception $e) {
            // Log the error with additional context
            Log::error('Error deleting ticket: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);

            // Return a generic error response
            return $this->responseError('Something went wrong', $e->getMessage(), 500);
        }
    }
}
