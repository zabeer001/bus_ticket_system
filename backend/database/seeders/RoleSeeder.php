<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 'Admin' and 'User' roles explicitly
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
    }
}
