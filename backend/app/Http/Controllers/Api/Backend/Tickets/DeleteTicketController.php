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
     * @OA\Delete(
     *     path="/api/tickets/{id}",
     *     summary="Delete a ticket by ID",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of the ticket to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted the ticket",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Ticket deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Ticket not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred while deleting the ticket",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Something went wrong"),
     *             @OA\Property(property="error", type="string", example="Error message")
     *         )
     *     )
     * )
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
