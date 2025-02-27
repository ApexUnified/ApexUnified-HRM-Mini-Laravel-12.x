<?php

namespace Database\Seeders;

use App\Models\MailSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailSetting::updateOrCreate(["mail_username" => "abdullahsheikhmuhammad21@gmail.com"], [
            'mail_mailer' => "smtp",
            'mail_host' => "smtp.gmail.com",
            'mail_port' => "587",
            'mail_password' => "mrrzavnqumkgdixq",
            'mail_encryption' => "tls",
            'mail_from' => "abdullahsheikhmuhammad21@gmail.com",
            'mail_from_name' => "Apex Unified HRM Mini",
            'mail_to' => "abdullahsheikhmuhammad21@gmail.com",
            'mail_sent_time' => "00:00",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
