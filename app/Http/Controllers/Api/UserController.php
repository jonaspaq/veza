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
        $data = User::paginate();

        return response()->json(['message' => 'Success', $data], 200);
    }

    /**
     * Show a specified resource 
     * 
     * @param \Illuminate\Http\Request $request
     * @return User::class
     */
    public function show($userId)
    {
        $data = User::find($userId);
        
        if($data){
            return response()->json($data);
        }

        return response()->json(null, 404);
    }

    /**
     * Register user, store the resource to database
     * @param App\Http\Requests\UserRegistration $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegistration $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $insertedData = User::create($data);

        return response()->json($insertedData, 201);
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
     * @param int $id
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

    /**
     * Return the details of the authenticated user
     * 
     * @return \Illuminate\Http\Response
    */
    public function authDetails(){
        $data = request()->user();

        return response()->json($data, 200);
    }
}
