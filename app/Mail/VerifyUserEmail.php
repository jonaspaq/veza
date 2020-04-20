<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\User;
use App\Traits\CustomHash;
use Illuminate\Support\Facades\URL;

class VerifyUserEmail extends Mailable
{
    use Queueable, SerializesModels, CustomHash;

    protected $user;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $this->url = URL::temporarySignedRoute('email.verification.verify', now()->addHour(1), [
                            'id' => $user->id,
                            'hash' => $this->hash($this->user->getNotVerifiedEmail())
                        ]
        );

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.email_verify')
                    ->with([
                        'url' => $this->url
                    ]);
    }
}
