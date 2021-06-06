<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory()->superAdmin()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        \App\Models\User::factory(10)->admin()->create();
        \App\Models\User::factory(90)->create();
    }
}
