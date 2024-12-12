<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function responseSuccess($data, $message = 'Request successful', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function responseError($message = 'Request failed', $error = null, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $error
        ], $code);
    }

    protected function authenticateUser()
    {
        try {
            // Try to authenticate the user from the token
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return $user; // Return the authenticated user

        } catch (JWTException $e) {
            // Handle invalid token error
            return response()->json(['error' => 'Invalid token'], 400);
        }
    }
    protected function isAdmin(){
        $user = $this->authenticateUser();

        // Check if the user has the 'role_id' of 1 (Admin or Authorized Role)
        if ($user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized'], 403); // Forbidden response
        }
        return true;
    }
}
