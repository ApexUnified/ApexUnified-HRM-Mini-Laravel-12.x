<?php

namespace Database\Seeders;

use App\Models\Bonus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bonuses = [];


        for ($i = 0; $i <= 5000; $i++) {
            $bonuses[] = [
                "bonus_type" => "Demo " . $i,
                "frequency" => "Monthly",
                "description" => "This is a demo bonus",
                "bonus_amount" => rand(100, 1000),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }



        Bonus::insert($bonuses);
    }
}
