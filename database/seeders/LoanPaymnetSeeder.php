<?php

namespace Database\Seeders;

use App\Models\LoanPayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanPaymnetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanPayments = [];


        for ($i = 0; $i <= 5000; $i++) {
            $loanPayments[] = [
                "employee_id" => 1,
                "loan_type" => "This is a demo bonus",
                "loan_amount" => rand(100, 1000),
                "loan_deduction_amount" => rand(100, 1000),
                "remeaning_loan" => rand(100, 1000),
                "status" => "Active",
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        LoanPayment::insert($loanPayments);
    }
}
