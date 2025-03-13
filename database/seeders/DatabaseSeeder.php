<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

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
        ]);
    }
}
