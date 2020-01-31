<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\User;

trait PassportAuth{

    /** This install passport client credentials */
    public function passportInstallCommando(){
        Artisan::call('passport:install');
    }

    /** Create a test user */
    public function createTestUser(){
        return factory(User::class)->create([
            'email' => 'test@example.com.unknown',
        ]);
    }

    /** Install passport and create a test user */
    public function passportAndCreateUser(){
        $this->passportInstallCommando();
        return $this->createTestUser();
    }

    public function authenticateFirst(){
        $this->passportInstallCommando();
        $this->createTestUser();

        $data = [
            'email' => 'test@example.com',
            'password' => 'password'
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();
            $access_token = $user->createToken('MyApp')->accessToken;
        }

        return strval($access_token);
    }

    public function loggedInHeader(){
        return [
            'Authorization' => 'Bearer '.$this->authenticateFirst(),
            'Accept' => 'application/json'
        ];
    }
}