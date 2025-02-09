<?php

namespace Database\Seeders;

use App\Models\Authentication;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Authentication::factory(10)->create();

        Authentication::factory()->create([
            'name' => 'Test Authentication',
            'email' => 'test@example.com',
        ]);
    }
}
