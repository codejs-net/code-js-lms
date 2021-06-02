<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->details['name']);
        return $this->view('email.sendmail')
                    ->subject($this->details['subject'])
                    ->from('library.bulathps@gmail.com','Library')
                    ->with([
                        'name' => $this->details['name'],
                        'body' => $this->details['body'],
                    ]);
    
    }
}
