<?php

namespace Database\Seeders;

use App\Models\Overtime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OvertimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $overtimes = [];


        for ($i = 0; $i <= 5000; $i++) {
            $overtimes[] = [
                "employee_id" => 1,
                "hours_worked" => 2,
                "rate_per_hour" => 100,
                "total_overtime_pay" => 200,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        Overtime::insert($overtimes);
    }
}
