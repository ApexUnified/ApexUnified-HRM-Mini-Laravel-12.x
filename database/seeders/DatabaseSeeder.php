<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            ModelHasRoleSeeder::class,
            CurrencySeeder::class,
            SettingSeeder::class,
            MailSettingSeeder::class,
            BranchSeeder::class,
            DepartmentSeeder::class,
            AllowanceTypeSeeder::class,
            JobNatureTypeSeeder::class,
            PositionLevelSeeder::class
            // EmployeeSeeder::class
            // PayslipSeeder::class
            // CashAdvanceSeeder::class
            // AdvanceSalarySeeder::class
        ]);
    }
}
