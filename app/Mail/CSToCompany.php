<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CSToCompany extends Mailable
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
        switch($this->data['from']){
            case 'account@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_ACC_USER','noreply@at-once.info'));
                Config::set('mail.mailers.smtp.password', env('MAIL_ACC_PASSWORD','qx7VN25jmd'));
                Config::set('mail.from.address', env('MAIL_ACC_USER'));
                $from = 'MAIL_ACC_USER';
            break;
            case 'account2@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_ACC2_USER'));
                Config::set('mail.mailers.smtp.password', env('MAIL_ACC2_PASSWORD'));
                Config::set('mail.from.address', env('MAIL_ACC2_USER'));
                $from = 'MAIL_ACC2_USER';
            break;
            case 'cs@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_CS_USER','cs@at-once.info'));
                Config::set('mail.mailers.smtp.password', env('MAIL_CS_PASSWORD','UV2zf3gL'));
                Config::set('mail.from.address',env('MAIL_CS_USER','cs@at-once.info'));
                $from = 'MAIL_CS_USER';
            break;
            case 'cs2@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_CS2_USER','cs2@at-once.info'));
                Config::set('mail.mailers.smtp.password', env('MAIL_CS2_PASSWORD','Bnmi4lwc'));
                Config::set('mail.from.address',env('MAIL_CS2_USER','cs2@at-once.info'));
                $from = 'MAIL_CS2_USER';
            break;
            case 'cs3@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_CS3_USER','cs3@at-once.info'));
                Config::set('mail.mailers.smtp.password', env('MAIL_CS3_PASSWORD','mUmxc32fq'));
                Config::set('mail.from.address', env('MAIL_CS3_USER','cs3@at-once.info'));
                $from = 'MAIL_CS3_USER';
            break;
            case 'cs4@at-once.info':
                Config::set('mail.mailers.smtp.username', env('MAIL_CS4_USER','cs4@at-once.info'));
                Config::set('mail.mailers.smtp.password', env('MAIL_CS4_PASSWORD','4FmDgkIRPe'));
                Config::set('mail.from.address', env('MAIL_CS4_USER','cs4@at-once.info'));
                $from = 'MAIL_CS4_USER';
            break;
        }
        // print_r(Config::get('mail'));
        $send =  $this->subject($this->data['subject'])
        ->from(/*'noreply@at-once.info'*/$this->data['from'], env('APP_NAME'))
        ->to($this->data['to']);

        if(@$this->data['cc']!='') $send->bcc($this->data['cc']);
        if(@$this->data['attach']!='') $send->attachFromStorageDisk(env('disk'),$this->data['attach']);
        $send->markdown('email.CSToCompany')->with(['content' => @$this->data['content']]);
    }
}
