<?php

namespace Database\Seeders;

use App\Models\AdvanceSalary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvanceSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advance_salaries = [];


        for ($i = 1; $i <= 100; $i++) {
            $advance_salaries[] = [
                "employee_id" => 1,
                "advance_salary_reason" => "HAHAHHA",
                "advance_salary_date" => date("Y-m-d"),
                "advance_salary_amount" => 5000,
                "advance_salary_status" => "Pending"
            ];
        }


        AdvanceSalary::insert($advance_salaries);
    }
}
