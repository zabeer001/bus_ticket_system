<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="API documentation for User management"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    // Show a list of all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Get a single user by ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    // Show a single user by ID
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
}
