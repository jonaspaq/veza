<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\MessageThread;

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

        $data = MessageThread::where('user_one', $authenticatedUserId)
                        ->orWhere('user_two', $authenticatedUserId)
                        ->with('sender', 'receiver')
                        ->orderBy('last_activity', 'asc')
                        ->paginate();

        $data = json_encode($data);
        $data = json_decode($data);

        if(!empty($data->data))
        {
            return response()->json($data);
        }

        return response()->json($data, 204);
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
