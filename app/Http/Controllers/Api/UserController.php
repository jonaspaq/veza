<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

use App\User;
use App\Traits\PasswordMatchCheck;
use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserLogin;
use App\Http\Requests\UserUpdateDetails;
use App\Http\Requests\UserChangeEmail;
use App\Http\Requests\UserChangePassword;

class UserController extends Controller
{
    use PasswordMatchCheck;

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
     * @param $userId - I.D of a user
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
     *
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
     * @param  App\Http\Request\UserUpdateDetails  $request
     * @param  int  $id - I.D of a user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateDetails $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->validated());

        return response()->json($user);
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

    /**
     * Attempt to login/authenticate a user.
     *
     * @param  App\Http\Request\UserLogin  $request
     * @return \Illuminate\Http\Response
     */
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
        $data->full_name = $data->fullName();

        return response()->json($data, 200);
    }

    /**
     * Change/Update the email of the authenticated user
     *
     * @param \App\Http\Requests\ChangeEmail $request
     * @return \Illuminate\Http\Response
     */
    public function changeEmail(UserChangeEmail $request)
    {
        $user = $request->user();
        $data = $request->validated();
        $updateData = [
            'email' => $data['email'],
            'email_verified_at' => null
        ];

        // Check if password is correct
        $this->passwordMatchCheck($user->password, $data['password']);

        $user->update($updateData);

        // Email a verification link to the new email
        $req = Request::create(route('verification.resend'), 'GET');
        $ret = app()->handle($req);

        return response()->json([
            'message' => 'A mail has been sent to verify the new email. Please check your inbox.',
            'user' => $user,
        ]);
    }

    /**
     * Change the password of the user
     *
     * @param \App\Http|Requests\UserChangePassword $request
     * @return \Illuminate\Http|Response
     */
    public function changePassword(UserChangePassword $request)
    {
        $user = $request->user();
        $this->passwordMatchCheck($user->password, $request->old_password);

        $newPassword = $request->only('password');
        $newPassword['password'] = Hash::make($newPassword['password']);

        $user->update($newPassword);

        return response()->json(['message' => 'Password successfuly changed.']);
    }
}
