<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => RoleEnum::super_admin(),
        ]);
        \App\Models\User::factory(10)->create([
            'role' => RoleEnum::admin(),
        ]);
        \App\Models\User::factory(90)->create([
            'role' => RoleEnum::user(),
        ]);
    }
}
