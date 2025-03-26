<?php

namespace Database\Seeders;

use App\Models\TaxDeduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxDeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxdeductions = [];


        for ($i = 0; $i <= 5000; $i++) {
            $taxdeductions[] = [
                "tax_type" => "Demo " . $i,
                "tax_percentage" => 2,
                "tax_amount" => rand(100, 1000),
                "description" => "This is a demo bonus",
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        TaxDeduction::insert($taxdeductions);
    }
}
