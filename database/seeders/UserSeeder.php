<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ["email" => "admin@gmail.com"],
            ["name" => "Abdullah", "password" => 12345678, "created_at" => now(), "updated_at" => now()]
        );
    }
}
