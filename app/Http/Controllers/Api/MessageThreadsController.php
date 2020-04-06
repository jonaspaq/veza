<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\MessageThread;
use App\Message;

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
                        ->with('sender:id,name', 'receiver:id,name')
                        ->orderBy('last_activity', 'asc')
                        ->paginate();

        return response()->json($data);
    }

    /**
     * Create a message thread
     *
     * @param $request - Data of the post request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = $request->user()->id;
        $secondUser = $request->secondUser;

        $data = MessageThread::create([
            'user_one' => $authUser,
            'user_two' => $secondUser,
            'last_activity' => Carbon::now()
        ]);

       return response()->json($data);
    }

    /**
     * Select the specified message thread.
     *
     * @param  int  $id - I.D of the message thread
     * @return \Illuminate\Http\Response - return the paginated messages of this thread
     */
    public function show($id)
    {
        $data = MessageThread::find($id);

        // If thread does not exist, return 404
        if(!$data)
            return abort(404, 'Message Thread/Conversation not found');

        // Paginate data
        $data = $data->messages()->paginate();

        return response()->json($data);
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
     * Delete a message thread
     *
     * @param  int  $id - I.D of the message thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if message thread exist
    }
}
