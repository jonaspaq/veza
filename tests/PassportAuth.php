<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\User;

trait PassportAuth
{
    /** This installs passport client credentials */
    public function passportInstallCommando(){
        Artisan::call('passport:install');
        return $this;
    }

    /** Create a test user */
    public function createTestUser(){
        return factory(User::class)->create([
            'email' => 'test@example.com.unknown',
        ]);
    }

    /** Create a random test user */
    public function createRandomUser(){
        return factory(User::class)->create([
            'email' => 'test'.rand(1, 100).'@example.com.unknown',
        ]);
    }

    /** Install passport and create a test user */
    public function passportAndCreateUser(){
        return $this->passportInstallCommando()->createTestUser();
    }
}