<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Branch::doesntExist()) {
            Branch::create([
                'name' => "Default Branch",
                'address' => "Default Addresss",
                'latitude' => 24.8991789,
                'longtitude' => 67.1874781,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
