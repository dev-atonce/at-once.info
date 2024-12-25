<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $this->subject('AT ONCE - Reset password')
        ->from('noreply@at-once.info',env('APP_NAME'))
        ->to($this->data['to'])
        ->markdown('email.reset-password')
        ->with(['url' => @$this->data['url']]);

    }
}
