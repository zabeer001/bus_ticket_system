<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::factory()->createMany([
            ['route_name' => 'Dhaka - Chittagong'],
            ['route_name' => 'Dhaka - Sylhet'],
            ['route_name' => 'Dhaka - Cox\'s Bazar'],
            ['route_name' => 'Dhaka - Rajshahi'],
            ['route_name' => 'Dhaka - Khulna'],
            ['route_name' => 'Dhaka - Rangpur'],
            ['route_name' => 'Dhaka - Barisal'],
            ['route_name' => 'Chittagong - Cox\'s Bazar'],
            ['route_name' => 'Sylhet - Khulna'],
            ['route_name' => 'Dinajpur - Dhaka'],
        ]);
    }
}
