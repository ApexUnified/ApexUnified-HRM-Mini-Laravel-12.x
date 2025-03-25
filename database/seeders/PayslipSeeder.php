<?php

namespace Database\Seeders;

use App\Models\Payslip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayslipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Payslip::truncate();

        $Payslips = [];
        for ($i = 0; $i <= 50; $i++) {
            $payslips[] = [
                'employee_id' => 1,
                'base_salary' => 500000,
                'overtime' => 500,
                'allowance' => 1000,
                'bonus' => 1000,
                'deduction' => 500,
                'tax_deduction' => 100,
                'net_salary' => 501000,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        Payslip::insert($payslips);
    }
}
