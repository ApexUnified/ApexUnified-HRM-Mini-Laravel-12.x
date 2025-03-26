<?php

namespace Database\Seeders;

use App\Models\Deduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deductions = [];


        for ($i = 0; $i <= 5000; $i++) {
            $deductions[] = [
                "deduction_type" => "Demo " . $i,
                "description" => "This is a demo bonus",
                "deduction_amount" => rand(100, 1000),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        Deduction::insert($deductions);
    }
}
