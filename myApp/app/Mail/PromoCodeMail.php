<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoCodeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $promoCode;

    public function __construct($promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function build()
    {
        return $this->subject('Mã khuyến mãi dành cho bạn')
            ->view('emails.promo_code');
    }
}
