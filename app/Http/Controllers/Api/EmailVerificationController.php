<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;

use App\User;
use App\Traits\CustomHash;

class EmailVerificationController extends Controller
{
    use CustomHash;

    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 403);
        }

        $user->markEmailAsVerified();
        // if ($user->markEmailAsVerified()) {
        //     event(new Verified($user));
        // }

        return response()->json(['message' => 'Successfully verified email.']);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json response
     */
    public function resend(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified.']);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification sent.']);
    }









    // --------------------------- CUSTOM EMAIL VERIFICATION -------------------------

    // public function __construct()
    // {
    //     $this->middleware('auth:api')->only('send');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'send');
    // }

    /**
     * Send a verification email for the non verified email
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function send(Request $request)
    // {
    //     $user = $request->user();

    //     // Check if emails are verified
    //     if ($user->checkEmailsVerification())
    //         return response()->json(['message' => 'Emails are already verified.']);

    //     $user->sendNotificationToEmail();

    //     $emailToVerify = $user->getNotVerifiedEmail();

    //     return response()->json(['message' => 'Email verification sent to '.$emailToVerify.'.']);
    // }

    // public function verify(Request $request)
    // {
    //     $user = User::find($request->id);

    //     $emailToVerify = $this->hash($user->getNotVerifiedEmail());

    //     // Check if hash is equivalent
    //     if(! $emailToVerify == $request->hash)
    //         abort(401);

    //     $user->verifyTheEmail($emailToVerify);

    //     return response()->json(['message' => 'The email '.$user->getNotVerifiedEmail().' is now verified.']);
    // }
}
