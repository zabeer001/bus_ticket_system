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
     * @OA\Get(
     *     path="/api/tickets/{id}",
     *     summary="Retrieve a ticket by ID",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of the ticket to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved the ticket",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Ticket retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="schedule_id", type="integer"),
     *                 @OA\Property(property="payment_status", type="string"),
     *                 @OA\Property(property="user_id", type="integer"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *             )
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
     *         description="An error occurred while retrieving the ticket",
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
