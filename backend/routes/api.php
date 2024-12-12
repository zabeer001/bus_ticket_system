<?php

use App\Http\Controllers\Api\Backend\BusSchedule\DeleteBusScheduleController;
use App\Http\Controllers\Api\Backend\BusSchedule\ShowBusScheduleController;
use App\Http\Controllers\Api\Backend\BusSchedule\StoreBusScheduleController;
use App\Http\Controllers\Api\Backend\BusSchedule\UpdateBusScheduleController;
use App\Http\Controllers\Api\Backend\Tickets\DeleteTicketController;
use App\Http\Controllers\Api\Backend\Tickets\GetBusTicketController;
use App\Http\Controllers\Api\Backend\Tickets\ShowTicketController;
use App\Http\Controllers\Api\Backend\Tickets\StoreTicketController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| API Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "api" middleware group. Make something great! 
| 
*/


//bus-schedules
Route::post('bus-schedules', StoreBusScheduleController::class);
Route::put('bus-schedules/{id}', UpdateBusScheduleController::class); 
Route::delete('bus-schedules/{id}', DeleteBusScheduleController::class);
Route::get('bus-schedules/{id}', ShowBusScheduleController::class);


//tickets
Route::post('tickets', StoreTicketController::class);
Route::get('tickets/{id}', ShowTicketController::class);
Route::delete('tickets/{id}', DeleteTicketController::class);
Route::get('/tickets', GetBusTicketController::class);

