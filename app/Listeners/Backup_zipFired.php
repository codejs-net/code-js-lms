<?php

namespace App\Listeners;

use Spatie\Backup\Events\BackupZipWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Send_Backup_Mail;
use App\Models\setting;
use App\Http\Controllers\SoapController;
use Mail;


class Backup_zipFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BackupZipWasCreated  $event
     * @return void
     */
    public function handle(BackupZipWasCreated $event)
    {
        $SoapController = new SoapController;
        $setting_email_send = setting::where('setting', 'email_backup')->first();
        $details = [
            'body'      => basename($event->pathToZip, ".zip"),
            'subject'   => "DB Backup",
            'attach'    => $event->pathToZip
        ];

        if ($setting_email_send->value == "1") 
        {
            if($SoapController->is_connected()==true)
            {
                Mail::to(env("Backup_mail_address"))->send(new Send_Backup_Mail($details));
            } 
        } 
        
    }
}
