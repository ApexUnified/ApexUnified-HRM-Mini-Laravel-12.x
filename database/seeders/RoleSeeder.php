<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Role::exists()) {
            Role::insert([
                ["name" => "admin", "guard_name" => "web", "created_at" => now(), "updated_at" => now()],
                ["name" => "employee", "guard_name" => "web", "created_at" => now(), "updated_at" => now()]
            ]);
        }
    }
}
