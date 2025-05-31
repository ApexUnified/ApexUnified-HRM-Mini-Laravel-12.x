<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Setting::doesntExist()) {
            Setting::create(
                [
                    "system_title" => "ApexUnified HRM Mini",
                    "system_logo" =>  null,
                    "currency" =>     "Rs",
                    "favicon" =>      null,
                    "auth_logo" =>    null,
                    "company_name" => "ApexUnified",
                    "developed_by" => "Sheikh Abdullah",
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );
        }
    }
}
