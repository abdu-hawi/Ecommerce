<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $da=[];

    /**
     * Create a new message instance.
     *
     * @param array $dataArr
     */
    public function __construct($dataArr=[])
    {
        $this->da = $dataArr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.emails.admin_reset_password')
            ->subject('Reset Admin Password')
            ->with('data',$this->da);
    }
}
