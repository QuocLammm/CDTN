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
        $settings = [
            // General
            ['key' => 'site_logo', 'value' => null],
            ['key' => 'site_favicon', 'value' => null],
            ['key' => 'site_language', 'value' => null],

            // Email
            ['key' => 'mail_mailer', 'value' => null],
            ['key' => 'mail_host', 'value' => null],
            ['key' => 'mail_port', 'value' => null],
            ['key' => 'mail_username', 'value' => null],
            ['key' => 'mail_password', 'value' => null],
            ['key' => 'mail_encryption', 'value' => null],
            ['key' => 'mail_from_address', 'value' => null],
            ['key' => 'mail_from_name', 'value' => null],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
