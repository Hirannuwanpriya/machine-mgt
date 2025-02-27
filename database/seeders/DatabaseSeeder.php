<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Machine::factory(10)->create();

        Machine::factory()->create([
            'name' => 'Test Machine',
            'description' => 'This is a test machine',
            'purchase_date' => '2021-01-01',
            'price' => 1000,
            'category' => 1,
            'brand' => 2,
            'status' => 1,
            'sort_order' => 1,
        ]);
    }
}
