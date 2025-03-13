<?php

namespace Database\Seeders;

use App\Models\Jobnature;
use App\Models\JobNatureType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobNatureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (JobnatureType::doesntExist()) {
            JobNatureType::create([
                'jobnature_type' => "Permanent",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
