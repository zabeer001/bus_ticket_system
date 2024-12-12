<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{

    /**
     * @OA\Info(
     *     title="User API",
     *     version="1.0.0",
     *     description="API documentation for User management"
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/auth/user",
     *     summary="Get the authenticated user's profile",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved the user's profile",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="object", 
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                 @OA\Property(property="role_id", type="string", example="2")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid token")
     *         )
     *     )
     * )
     */

    public function __invoke(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }
}
