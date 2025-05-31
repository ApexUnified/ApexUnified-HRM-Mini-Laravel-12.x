<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Dashboard View',
            'Attendance View',
            'Attendance Create',
            'Attendance Edit',
            'Attendance Delete',
            'Department View',
            'Department Create',
            'Department Edit',
            'Department Delete',
            'Employee View',
            'Employee Create',
            'Employee Show',
            'Employee Edit',
            'Employee Delete',
            'Schedule View',
            'Schedule Create',
            'Schedule Edit',
            'Schedule Delete',
            'Device View',
            'Device Create',
            'Device Edit',
            'Device Delete',
            'Reports View',
            'Settings View',
            'User View',
            'User Create',
            'User Edit',
            'User Delete',
            'Job Nature View',
            'Job Nature Create',
            'Job Nature Edit',
            'Job Nature Delete',
            'Position View',
            'Position Create',
            'Position Edit',
            'Position Delete',
            'Allowance View',
            'Allowance Create',
            'Allowance Edit',
            'Allowance Delete',
            'Bonus View',
            'Bonus Create',
            'Bonus Edit',
            'Bonus Delete',
            'Loan View',
            'Loan Create',
            'Loan Edit',
            'Loan Delete',
            'Deduction View',
            'Deduction Create',
            'Deduction Edit',
            'Deduction Delete',
            'Tax Deduction View',
            'Tax Deduction Create',
            'Tax Deduction Edit',
            'Tax Deduction Delete',
            'Cash Advance View',
            'Cash Advance Create',
            'Cash Advance Edit',
            'Cash Advance Delete',
            'Advance Salary View',
            'Advance Salary Create',
            'Advance Salary Edit',
            'Advance Salary Delete',
            'Holiday View',
            'Holiday Create',
            'Holiday Edit',
            'Holiday Delete',
            "Overtime View",
            "Overtime Create",
            "Overtime Edit",
            "Overtime Delete",
            "Payroll View",
            "Payroll Create",
            "Payroll Edit",
            "Payroll Delete",
            "Payroll Invoice Generate",
        ];


        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName], [
                'guard_name' => 'web',
                "created_at" => now(),
                'updated_at' => now()
            ]);
        }
    }
}
