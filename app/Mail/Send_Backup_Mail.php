<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Send_Backup_Mail extends Mailable
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
        return $this->view('email.send_backup_mail')
        ->subject($this->details['subject'])
        ->attach($this->details['attach'])
        ->from('library.bulathps@gmail.com','Library')
        ->with([
            'body' => $this->details['body'],
        ]);
    
    }
}
