<?php

namespace App\Http\Controllers\Api\Backend\Tickets;

use App\Http\Controllers\Controller;
use App\Models\BusSchedule;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreTicketController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/tickets",
     *     summary="Create a new bus ticket",
     *     tags={"Tickets"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"schedule_id", "payment_status"},
     *             @OA\Property(property="schedule_id", type="integer", description="The ID of the bus schedule"),
     *             @OA\Property(property="payment_status", type="string", description="The status of the payment (e.g., paid, pending)"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully created a ticket",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Ticket created successfully"),
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
     *         response=400,
     *         description="All tickets are booked",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="All tickets are booked")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred while creating the ticket",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Something went wrong"),
     *             @OA\Property(property="error", type="string", example="Error message")
     *         )
     *     )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            // Authenticate the user using the method from the parent Controller
            $user = $this->authenticateUser();
    
            // Validate the request data
            $validated = $request->validate([
                'schedule_id' => 'required|exists:bus_schedules,id', // Ensure bus schedule exists
                'payment_status' => 'required', // Valid payment status
            ]);
    
            // Add the authenticated user's ID to the validated data
            $validated['user_id'] = $user->id;
    
            // Retrieve the bus schedule and check if there are remaining tickets
            $bus_schedule = BusSchedule::findOrFail($request->schedule_id);
    
            // If there are no remaining tickets, return a message
            if ($bus_schedule->remaining_tickets <= 0) {
                return $this->responseError('All tickets are booked', null, 400);
            }
    
            // Create a new ticket using the validated data
            $ticket = Ticket::create($validated);
    
            // Update the ticket sold and remaining tickets
            $bus_schedule->ticket_sold += 1;
            $bus_schedule->remaining_tickets -= 1;
            $bus_schedule->save();
    
            // Return the created ticket with a 201 status
            return $this->responseSuccess($ticket, 'Ticket created successfully', 201);
        } catch (\Exception $e) {
            // Log the error with additional context
            Log::error('Error creating ticket: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);
    
            // Return a generic error response using the helper method from the parent Controller
            return $this->responseError('Something went wrong', $e->getMessage(), 500);
        }
    }
}
