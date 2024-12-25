<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactToMe extends Mailable
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
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $send =  $this->subject($this->data['subject'])//ติดต่อสอบถาม
        ->from('noreply@at-once.info',env('APP_NAME'))
        ->to($this->data['to']);
        // ->cc($this->data['email']);
        // if(@$this->data['cc']!='') $send->bcc($this->data['cc']);
        $send->markdown('email.contact')
        ->with([
            'company' => @$this->data['company'],
            'telephone' => @$this->data['telephone'],
            'department' => @$this->data['department'],
            'name' => @$this->data['name'],
            'email' => @$this->data['email'],
            'detail' => @$this->data['detail']
        ]);

        // if(@$this->data['attachment']!='') $send->attachFromStorageDisk(env('disk'),$this->data['attachment']);

    }
}
