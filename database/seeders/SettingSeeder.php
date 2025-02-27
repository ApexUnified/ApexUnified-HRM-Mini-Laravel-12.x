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
                    "system_logo" =>  "SystemLogo.png",
                    "currency" =>     "Rs",
                    "favicon" =>      "Favicon.png",
                    "auth_logo" =>    "Auth_logo.png",
                    "company_name" => "ApexUnified",
                    "developed_by" => "Sheikh Abdullah",
                    "created_at" => now(),
                    "updated_at" => now()
                ]
            );
        }
    }
}
