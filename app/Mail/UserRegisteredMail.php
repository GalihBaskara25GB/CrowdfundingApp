<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Otp_code;

class UserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $otp_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Otp_code $otp_code)
    {
        $this->user = $user;
        $this->otp_code = $otp_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('customer_care@crowdfundMe.com')
                ->view('send_email_user_registered')
                ->with([
                        'name' => $this->user->name,
                        'otpCode' => $this->otp_code->otp_code,
                        'validUntil' => $this->otp_code->valid_until,
                    ]);
    }
}
