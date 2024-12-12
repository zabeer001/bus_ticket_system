<?php

namespace App\Http\Controllers\Api\Backend\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetBusTicketController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tickets",
     *     summary="Get bus tickets with optional filters",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Filter tickets by date",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="route_id",
     *         in="query",
     *         description="Filter tickets by route ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved bus tickets",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="bus_id", type="integer"),
     *                     @OA\Property(property="bus_name", type="string"),
     *                     @OA\Property(property="start_from", type="string"),
     *                     @OA\Property(property="time", type="string"),
     *                     @OA\Property(property="date", type="string", format="date"),
     *                     @OA\Property(property="route_name", type="string")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred while fetching ticket information",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while fetching ticket information."),
     *             @OA\Property(property="error", type="string", example="Error message")
     *         )
     *     )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            // Initialize the query builder
            $query = DB::table('bus_schedules')
                ->join('buses', 'bus_schedules.bus_id', '=', 'buses.id')
                ->join('routes', 'buses.route_id', '=', 'routes.id')
                ->select(
                    'buses.id as bus_id',
                    'buses.name as bus_name',
                    'bus_schedules.start_from',
                    'bus_schedules.time',
                    'bus_schedules.date',
                    'routes.route_name'
                );
            
            // Apply filters if needed
            if ($request->has('date')) {
                $query->where('bus_schedules.date', $request->date);
            }

            if ($request->has('route_id')) {
                $query->where('buses.route_id', $request->route_id);
            }

            // Fetch the data based on the filters or all data if no filters provided
            $tickets = $query->get();

            // Return the ticket information as a JSON response
            return response()->json([
                'success' => true,
                'data' => $tickets
            ], 200);

        } catch (\Exception $e) {
            // Handle any errors that might occur
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching ticket information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
