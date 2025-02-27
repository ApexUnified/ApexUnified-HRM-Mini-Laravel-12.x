<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Currency::doesntExist()) {
            Currency::create([
                'currency_name' => "PKR",
                'currency_symbol' => "Rs",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
