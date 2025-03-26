<?php

namespace Database\Seeders;

use App\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = [];


        for ($i = 0; $i <= 5000; $i++) {
            $loans[] = [
                "employee_id" => 1,
                "loan_date" => now()->format("Y-m-d"),
                "loan_type" => "This is a demo bonus",
                "loan_amount" => rand(100, 1000),
                "loan_deduction_amount" => rand(100, 1000),
                "remeaning_loan" => rand(100, 1000),
                "repayment_date" => now()->format("Y-m-d"),
                "status" => "Active",
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        Loan::insert($loans);
    }
}
