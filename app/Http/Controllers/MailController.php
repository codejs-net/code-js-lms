<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
// use App\Http\Requests;

class MailController extends Controller
{
    public function send_email($to,$subject,$name,$body) {
        $details = [
            'name'      => $name,
            'body'      => $body,
            'subject'   => $subject
        ];
        Mail::to($to)->send(new SendMail($details));
     }


     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message ->to('abc@gmail.com', 'Tutorials Point')
                    ->subject('Laravel HTML Testing Mail');
           $message ->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
     }
     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
           $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }
}
