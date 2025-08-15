<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $save;

    function __construct($save)
    {
        $this->save = $save;
    }

    public function build()
    {
        return $this->markdown('email.Registered_mail')->
            subject(config('app.name').', Registered Mail Password Set');
    }


}