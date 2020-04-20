<?php

namespace App\Traits;

use App\Mail\VerifyUserEmail;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Traits\CustomHash;

trait CustomEmailVerification
{
    use CustomHash;

    /**
     * Check if the user has a non verified email
     */
    public function checkEmailsVerification()
    {
        foreach($this->emails as $email)
        {
            if(empty($email->email_verified_at))
                return false;
        }

        return true;
    }

    /**
     * Get the raw email that is not verified
     */
    public function getNotVerifiedEmail()
    {
        foreach($this->emails as $email)
        {
            if(empty($email->email_verified_at))
                return $email->email;
        }

        return null;
    }

    /**
     * Get the instance of the email that is not verified
     */
    public function getNotVerifiedEmailInstance()
    {
        foreach($this->emails as $email)
        {
            if(empty($email->email_verified_at))
                return $email;
        }

        return null;
    }

    /**
     * Send the email verification
     */
    public function sendNotificationToEmail()
    {
        Mail::to($this)->send(new VerifyUserEmail($this));
    }

    /**
     * Verify the email address
     *
     * @param $email - Hashed email address to verify
     * @return \Illuminate\Http\Response
     */
    public function verifyTheEmail($email)
    {
        // Check if the non verified email still exists or still not verified
        if(! $this->getNotVerifiedEmailInstance())
            abort(404);

        // Check if email matches to non verified email
        if(! $this->hash($this->getNotVerifiedEmailInstance()->email) == $email)
            abort(403);

        $emailToVerify = $this->getNotVerifiedEmailInstance();

        $emailToVerify->update([
            'email_verified_at' => Carbon::now()
        ]);

        return $emailToVerify;
    }
}
