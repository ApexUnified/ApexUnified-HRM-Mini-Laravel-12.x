<?php

namespace Database\Seeders;

use App\Models\Allowance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allowances = [];


        Allowance::truncate();

        for ($i = 0; $i <= 5000; $i++) {
            $allowances[] = [
                "allowance_type" => "TEST",
                "frequency" => "Monthly",
                "allowance_amount" => 2500,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        Allowance::insert($allowances);
    }
}
