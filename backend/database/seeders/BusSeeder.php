<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Route;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are existing routes
        if (Route::count() === 0) {
            $this->call(RouteSeeder::class);
        }

        // Create buses and associate them with routes
        Bus::factory(10)->create();
    }
}
