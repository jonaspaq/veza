<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendMessage;
use App\MessageThread;
use App\Message;

class MessageController extends Controller
{
    /**
     * Store a new message
     *
     * @param  \Illuminate\Http\SendMessage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendMessage $request)
    {
        $data = $request->validated();

        $threadId = $data['thread_id'];
        $authUser = $request->user()->id;

        // Check if a thread exist and if the user is related to it
        $thread = MessageThread::where('id', $threadId)
                                ->where(function($query) use ($authUser) {
                                    $query->where('user_one', $authUser)
                                        ->orWhere('user_two', $authUser);
                                })
                                ->firstOrFail();

        // Create the message
        $message = $thread->messages()->create([
            'user_id' => $authUser,
            'body' => $data['body'],
            'messageable_type' => 'MessageThread',
            'messageable_id' => $threadId
        ]);

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authUser = request()->user()->id;

        $message = Message::where('user_id', $authUser)
                        ->where('id', $id)
                        ->with('messageable')
                        ->firstOrFail();

        $thread = $message->messageable;

        if($thread->user_one == $authUser || $thread->user_two == $authUser) {
            $message = $message->delete();

            return response()->json($message);
        }
    }

    /**
     * Fetch messages from a message-thread
     *
     * @param $id - I.D of the message-thread
     * @return array of paginated messages
     */
    public function messages($id)
    {
        $authUser = request()->user()->id;

        // Check if a thread exist and if the user is related to it
        $thread = MessageThread::where('id', $id)
                                ->where(function($query) use ($authUser) {
                                    $query->where('user_one', $authUser)
                                        ->orWhere('user_two', $authUser);
                                })
                                ->firstOrFail();

        // Fetch all messages from this thread
        $messages = $thread
                    ->messages()
                    ->select('id','user_id','body','created_at','updated_at')
                    ->with('sender:id,name')
                    ->paginate();

        return response()->json($messages);
    }
}
