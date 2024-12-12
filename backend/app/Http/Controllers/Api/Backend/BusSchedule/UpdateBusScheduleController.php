<?php

namespace App\Http\Controllers\Api\Backend\BusSchedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusScheduleRequest;
use App\Models\BusSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateBusScheduleController extends Controller
{
   /**
 * @OA\Put(
 *     path="/api/bus-schedules/{id}",
 *     summary="Update an existing bus schedule",
 *     tags={"BusSchedule"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the bus schedule to be updated",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"bus_id", "start_from", "date", "time", "total_tickets", "ticket_sold", "remaining_tickets", "price"},
 *             @OA\Property(property="id", type="integer", example=1, description="ID of the bus schedule"),
 *             @OA\Property(property="bus_id", type="integer", example=1, description="ID of the bus"),
 *             @OA\Property(property="start_from", type="string", example="Cumilla", description="Location where the bus starts"),
 *             @OA\Property(property="date", type="string", format="date", example="2024-12-15", description="Date of the bus schedule"),
 *             @OA\Property(property="time", type="string", format="time", example="12:30", description="Time when the bus departs"),
 *             @OA\Property(property="total_tickets", type="integer", example=50, description="Total number of tickets available for the bus schedule"),
 *             @OA\Property(property="ticket_sold", type="integer", example=10, description="Number of tickets already sold"),
 *             @OA\Property(property="remaining_tickets", type="integer", example=40, description="Remaining tickets for the bus schedule"),
 *             @OA\Property(property="price", type="number", format="float", example=250.50, description="Price per ticket for the bus schedule")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully updated the bus schedule",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="bus_id", type="integer", example=2),
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
 *         response=404,
 *         description="Bus schedule not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Bus schedule not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request, validation errors",
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

    public function __invoke(BusScheduleRequest $request, $id)
    {
        try {
            $this->isAdmin();
            $schedule = BusSchedule::findOrFail($id);
            $schedule->update($request->validated());
            return response()->json($schedule, 200);
        } catch (\Exception $e) {
            Log::error('Error updating bus schedule: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
