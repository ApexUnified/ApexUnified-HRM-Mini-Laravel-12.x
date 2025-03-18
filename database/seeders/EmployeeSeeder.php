<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 10; $i++) {
            // Employee::create([
            //     "employee_id" => "EMP-" . rand(0000, 99999) . substr(uniqid(), -2),
            //     "employee_name" => "Demo Emp" . $i,
            //     "parent_name" => "Demo Parent" . $i,
            //     "employee_dob" => "1990-01-01",
            //     "date_of_hiring" => "2022-01-01",
            //     "department_id" => 1,
            //     "employee_schedule" => "2",
            //     "designation" => "Demo Position",
            //     "device_id" => '["1"]',
            //     "device_user_id" => rand(111, 999),
            // ]);




            Employee::create([
                'employee_id' =>  "EMP-" . rand(0000, 99999) . substr(uniqid(), -2),
                'parent_name' => "Device Created User",
                'employee_dob' => now()->format("Y-m-d"),
                'date_of_hiring' => now()->format("Y-m-d"),
                'department_id' => 1,
                'employee_schedule' => "No Schedule Assigned",
                'device_id' => '["1"]',
                'device_user_id' => rand(111, 999),
                'employee_name' => $i . "rando",
                'designation' => "No Designation Assigned"
            ]);
        }
    }
}
