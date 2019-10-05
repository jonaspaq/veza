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

        return response()->json(['message' => 'Retrieved all users', $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['message' => 'Successful Authentication', 'access_token' => $success['token'], 'user' => $user], 200);
        }
        
        return response()->json(['message' => 'Invalid Credentials'], 404);
        
    }

    public function register(UserRegistration $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $insertedData = User::create($data);
        return $insertedData;
    }
}
