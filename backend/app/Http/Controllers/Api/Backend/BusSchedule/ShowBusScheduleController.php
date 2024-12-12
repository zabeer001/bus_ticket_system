<?php

namespace App\Http\Controllers\Api\Backend\BusSchedule;

use App\Http\Controllers\Controller;
use App\Models\BusSchedule;
use Illuminate\Support\Facades\Log;

class ShowBusScheduleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/bus-schedules/{id}",
     *     summary="Get a specific bus schedule by ID",
     *     tags={"BusSchedule"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the bus schedule to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully fetched the bus schedule",
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
     *         response=404,
     *         description="Bus schedule not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Bus schedule not found")
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


    public function __invoke($id)
    {
        try {
            // Find the bus schedule by ID
            $schedule = BusSchedule::findOrFail($id);
            return response()->json($schedule, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching bus schedule: ' . $e->getMessage());
            return response()->json(['error' => 'Bus schedule not found'], 404);
        }
    }
}
