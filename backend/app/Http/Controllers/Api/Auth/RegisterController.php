<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user and generate JWT token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe", description="The name of the user"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com", description="The email address of the user"),
     *             @OA\Property(property="password", type="string", example="password123", description="The password for the user"),
     *             @OA\Property(property="password_confirmation", type="string", example="password123", description="The confirmation of the password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully and token generated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="johndoe@example.com")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="jwt_token_example")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An unexpected error occurred.")
     *         )
     *     )
     * )
     */
    public function __invoke(RegisterRequest $request)
    {
        try {
            // Create user with validated data
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            // Generate JWT token for the newly created user
            $token = JWTAuth::fromUser($user);

            // Return the success response with user data and token
            return response()->json(compact('user', 'token'), 201);
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., database errors) gracefully
            return response()->json([
                'status' => 'error',
                'message' => 'User registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
