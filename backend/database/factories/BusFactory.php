<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusFactory extends Factory
{
    protected $model = Bus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Bus', // Example: "Starline Bus"
            'seat' => $this->faker->numberBetween(30, 50), // Seats between 30 and 50
            'route_id' => Route::factory(), // Create a new route if none exists
        ];
    }
}
