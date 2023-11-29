<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipMail extends Mailable
{
    use SerializesModels;

    public $membership;

    public function __construct($membership)
    {
        $this->membership = $membership;
    }

    public function build()
    {
        return $this->subject('Membership Purchased Successfully')
            ->markdown('emails.membership');
    }
}
?>
<?php
