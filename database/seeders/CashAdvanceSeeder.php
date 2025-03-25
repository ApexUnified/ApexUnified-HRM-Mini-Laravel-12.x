<?php

namespace Database\Seeders;

use App\Models\CashAdvance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashAdvanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashAdvances = [];


        for ($i = 0; $i <= 100; $i++) {
            $cashAdvances[] = [
                'employee_id' => 1,
                'advance_type' => "rand",
                'advance_amount' => rand(1000, 10000),
                'advance_date' => date('Y-m-d'),
                'advance_status' => "Pending",
                'description' => 'Advance for employee ' . rand(1, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }



        CashAdvance::insert($cashAdvances);
    }
}
