<?php

namespace App\Http\Controllers\Api\Backend\BusSchedule;

use App\Http\Controllers\Controller;
use App\Models\BusSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeleteBusScheduleController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/bus-schedules/{id}",
     *     summary="Delete a bus schedule by ID",
     *     tags={"BusSchedule"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the bus schedule to delete",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted the bus schedule",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Bus schedule deleted successfully")
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
            $this->isAdmin();
            // Find the bus schedule by ID
            $schedule = BusSchedule::findOrFail($id);
            // Delete the schedule
            $schedule->delete();
            return response()->json(['message' => 'Bus schedule deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting bus schedule: ' . $e->getMessage());
            return response()->json(['error' => 'Bus schedule not found'], 404);
        }
    }
}
