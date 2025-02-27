<?php

namespace Database\Seeders;

use App\Models\AllowanceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllowanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (AllowanceType::doesntExist()) {
            AllowanceType::create([
                'allowance_type' => "Attendance Allowance",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
