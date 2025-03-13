<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (Db::table("model_has_roles")->where("role_id", "=", 1)->where("model_id", "=", 1)->doesntExist()) {
            DB::table("model_has_roles")->insert(["role_id" => 1, "model_type" => "App\Models\User", "model_id" => 1]);
        }
    }
}
