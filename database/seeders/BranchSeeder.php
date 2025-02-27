<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Branch::doesntExist()) {
            Branch::create([
                'name' => "Default Branch",
                'address' => fake()->address(),
                'latitude' => fake()->latitude(),
                'longtitude' => fake()->longitude(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
