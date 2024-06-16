<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait PasswordMatchCheck
{

    /**
     * Checks if the $checkPass matches
     * the hashed $userPassword
     *
     * @param string $userPassword - Authenticated user password
     * @param string $checkPass - The password to be checked
     * @return boolean
     * @throws abort If it doesn't match
     */
    public function passwordMatchCheck(string $userPassword, string $checkPass)
    {
        $check = Hash::check($checkPass, $userPassword);

        if($check)
            return true;

        abort(403, 'Password incorrect.');
    }
}
