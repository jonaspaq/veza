<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\MessageThreads;

class MessageThreadsController extends Controller
{
    /**
     * Display the most recent conversations of the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authenticatedUserId = request()->user()->id;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        MessageThreads::create([
            'user_one' => 1,
            'user_two' => 52,
            'last_activity' => $date
            ]);
        $data = MessageThreads::where('user_one', $authenticatedUserId)
                        ->orWhere('user_two', $authenticatedUserId)
                        ->with('sender', 'receiver')
                        ->paginate();

        $data = json_encode($data);
        $data = json_decode($data);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
