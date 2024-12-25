<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShareBlog extends Mailable
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
        $send =  $this->subject('The Best Blog Recomment For You.')
            ->from('noreply@at-once.info',env('APP_NAME','At Once'))
            ->to($this->data['to'])
            ->cc($this->data['email']);
            // ->cc('rachata.arnankul@gmail.com');

        $send->markdown('email.shareBlog')
            ->with([
                'blogUrl' => @$this->data['blogUrl'],
                'blogImg' => @$this->data['blogImg'],
            ]);
    }
}
