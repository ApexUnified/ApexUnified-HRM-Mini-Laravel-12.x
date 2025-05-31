<?php

namespace Database\Seeders;

use App\Models\PositionLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PositionLevel::doesntExist()) {
            PositionLevel::create([
                'position_level' => "Senior",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
