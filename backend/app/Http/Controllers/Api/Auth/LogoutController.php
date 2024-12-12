<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout the authenticated user",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Could not log out, please try again later")
     *         )
     *     )
     * )
     */


    public function __invoke()
    {
        try {
            // Invalidate the token
            JWTAuth::invalidate(JWTAuth::getToken());

            // Return success response
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            // Handle the error if token invalidation fails
            return response()->json(['error' => 'Could not log out, please try again later'], 500);
        }
    }
}
