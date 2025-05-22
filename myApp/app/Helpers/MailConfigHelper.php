<?php

namespace App\Helpers;

use App\Models\Setting;

class MailConfigHelper
{
    public static function loadFromDatabase()
    {
        $settings = Setting::whereIn('key', [
            'mail_mailer',
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_password',
            'mail_encryption',
            'mail_from_address',
            'mail_from_name',
        ])->pluck('value', 'key');

        config([
            'mail.default' => $settings['mail_mailer'],
            'mail.mailers.smtp.host' => $settings['mail_host'],
            'mail.mailers.smtp.port' => $settings['mail_port'],
            'mail.mailers.smtp.username' => $settings['mail_username'],
            'mail.mailers.smtp.password' => $settings['mail_password'],
            'mail.mailers.smtp.encryption' => $settings['mail_encryption'],
            'mail.from.address' => $settings['mail_from_address'],
            'mail.from.name' => $settings['mail_from_name'],
        ]);
    }
}
