<?php

namespace App\Http\Controllers\Api\Backend\BusSchedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusScheduleRequest;
use App\Models\BusSchedule;
use Illuminate\Support\Facades\Log;

class StoreBusScheduleController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/bus-schedules",
     *     summary="Create a new bus schedule",
     *     tags={"BusSchedule"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"bus_id", "start_from", "date", "time", "total_tickets", "ticket_sold", "remaining_tickets", "price"},
     *             @OA\Property(property="bus_id", type="integer", example=1),
     *             @OA\Property(property="start_from", type="string", example="Cumilla"),
     *             @OA\Property(property="date", type="string", format="date", example="2024-12-15"),
     *             @OA\Property(property="time", type="string", format="time", example="12:30"),
     *             @OA\Property(property="total_tickets", type="integer", example=50),
     *             @OA\Property(property="ticket_sold", type="integer", example=10),
     *             @OA\Property(property="remaining_tickets", type="integer", example=40),
     *             @OA\Property(property="price", type="number", format="float", example=250.50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully created a new bus schedule",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="bus_id", type="integer", example=1),
     *             @OA\Property(property="start_from", type="string", example="Cumilla"),
     *             @OA\Property(property="date", type="string", format="date", example="2024-12-15"),
     *             @OA\Property(property="time", type="string", format="time", example="12:30"),
     *             @OA\Property(property="total_tickets", type="integer", example=50),
     *             @OA\Property(property="ticket_sold", type="integer", example=10),
     *             @OA\Property(property="remaining_tickets", type="integer", example=40),
     *             @OA\Property(property="price", type="number", format="float", example=250.50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Validation errors")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Something went wrong")
     *         )
     *     )
     * )
     */
    public function __invoke(BusScheduleRequest $request)
    {
        try {
            // Authenticate the user (ensure the user is an admin)
            $this->isAdmin();

            // Create the bus schedule using validated data
            $schedule = BusSchedule::create($request->validated());

            // Return the created bus schedule with a 201 status
            return response()->json($schedule, 201);
        } catch (\Exception $e) {
            // Log the error with additional context
            Log::error('Error creating bus schedule: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);

            // Return a generic error response
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
