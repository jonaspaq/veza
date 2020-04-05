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
                        ->with('sender:id,name', 'receiver:id,name')
                        ->orderBy('last_activity', 'asc')
                        ->paginate();

        return response()->json($data);
    }

    /**
     * Create a message thread
     *
     * @param  $receiver - I.D of the second user
     *
     * @return \Illuminate\Http\Response
     */
    public function store($receiver)
    {
        $authenticatedUserId = request()->user()->id;

        $data = MessageThread::create([
            'user_one' => $authenticatedUserId,
            'user_two' => $receiver,
            'last_activity' => Carbon::now()
        ]);

        return response()->json($data);
    }

    /**
     * Select the specified message thread.
     * Create one if it doesn't exist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Check if thread exists
        $check = MessageThread::where('id', $id)->exists();

        $messages = null;

        if($check) {
            $messages = MessageThread::where('id', $id)
                                    ->with('messages')
                                    ->get();
        } else {
            $data = $this->store($id);
            $data->messages = [];
            return $data;
        }

        return response()->json($messages);
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

    /**
     * Validate if a message thread exist
     * If not, create a new message thread
     *
     * @param int $id - The id of the second user to message
     * @return Boolean
     */
    public function validateMessageThread($id)
    {
        // Checks if the user exists
        User::findOrFail($id);

        $authenticatedUserId = request()->user()->id;
        $secondUser = $id;

        // Checks if a thread exists
        $data = MessageThread::whereIn('user_one', [$authenticatedUserId, $secondUser])
                            ->orWhereIn('user_two', [$authenticatedUserId, $secondUser])
                            ->exists();

        if(!$data) {
            MessageThread::create([
                'user_one' => $authenticatedUserId,
                'user_two' => $secondUser,
                'last_activity' => Carbon::now()
            ]);
        }

        return $data;
    }
}
