<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DayPassMail extends Mailable
{
    use SerializesModels;

    public $dayPass;

    public function __construct($dayPass)
    {
        $this->dayPass = $dayPass;
    }

    public function build()
    {
        return $this->subject('Day Pass Purchased Successfully')
            ->markdown('emails.daypass');
    }
}
?>
