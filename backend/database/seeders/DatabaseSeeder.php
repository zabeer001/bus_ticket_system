<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the roles first
        $this->call([
            RoleSeeder::class, // Add the RoleSeeder here
        ]);

        // Create 10 random users using factory
        \App\Models\User::factory(10)->create();

        // Create a specific user with custom attributes
        \App\Models\User::factory()->create([
            'name' => 'zabeer',
            'email' => 'z@gmail.com',
            'password' => Hash::make('password'), // Make sure to hash the password
            'role_id' => 1
        ]);

        $this->call([
            RouteSeeder::class,
            BusSeeder::class,
        ]);
    }
}
