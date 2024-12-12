<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// composer require "darkaonline/l5-swagger"
// Publish the configuration file to customize Swagger settings:

// php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
//php artisan l5-swagger:generate