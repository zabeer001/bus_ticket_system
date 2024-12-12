<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;



class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login and get JWT token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"email", "password"},
     *                 @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="secretpassword")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful, token returned",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid credentials")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Could not create token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Could not create token")
     *         )
     *     ),
     *     security={{
     *         "bearerAuth": {}
     *     }}
     * )
     */


    public function __invoke(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get the authenticated user.
            $user = auth()->user();

            // (optional) Attach the role to the token.
            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
