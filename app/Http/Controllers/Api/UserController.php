<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

use App\User;
use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserLogin;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return response()->json(['message' => 'Success', $data], 200);
    }

    /**
     * Show a specified resource according 
     * to the owner of the access token
     * 
     * @param \Illuminate\Http\Request $request
     * @return User::class
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $request;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(UserLogin $request){
        $data = $request->validated();

        if(Auth::attempt($data)){
            $user = Auth::user();
            $access_token =  $user->createToken('MyApp')->accessToken;

            return response()->json(['message' => 'Successful Authentication', 'access_token' => $access_token, 'user' => $user], 200);
        }
        
        return response()->json(['message' => 'Invalid Credentials'], 404);
        
    }

    public function register(UserRegistration $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $insertedData = User::create($data);

        return response()->json($insertedData, 201);
    }
}
