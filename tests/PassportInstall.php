<?php

namespace Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PassportInstall{

    public static function installPassportClient(){

        $client1 = Str::random(40);
        $client2 = Str::random(40);

        DB::table('oauth_clients')->insert([
            [
                'name' => 'Veza Personal Access Client', 
                'secret' => $client1,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
            ],
            [
                'name' => 'Veza Password Grant Client', 
                'secret' => $client2,
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
            ]
        ]);

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => 1,
        ]);
    }
}