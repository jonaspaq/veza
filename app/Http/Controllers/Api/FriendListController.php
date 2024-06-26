<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FriendList;
use App\Events\NewFriendRequest;
use DB;

class FriendListController extends Controller
{
    protected $withSender = 'sender:id,first_name,middle_name,last_name,email';
    protected $withReceiver = 'receiver:id,first_name,middle_name,last_name,email';

    /**
     * Fetch all friend list which status is friends
     * Notice: This fetches the current user friends only
     * @param Request $request
    */
    public function index(Request $request){

        // Get the user id who made the request
        $authID = $request->user()->id;

        $data = FriendList::where('status', 'friends')
                // We use the "use" function here because "Closures has there own local scope they dont see outer variables"
                ->where(function($query) use($authID){
                    $query->where('user_one', $authID)
                    ->orWhere('user_two', $authID);
                })
                ->with($this->withSender, $this->withReceiver)
                ->paginate();

        return response()->json($data);
    }

    /**
     * Fetch all pending received friend requests
     * @param Request $request
    */
    public function pendingReceivedRequests(Request $request)
    {
        $data = $request->user()->friendReceived()
            ->select('id', 'user_one', 'created_at')
            ->where('status', 'pending')
            ->with($this->withSender)
            ->orderBy('id', 'desc')
            ->paginate();

        $data = json_encode($data);
        $data = json_decode($data);

        if(!empty($data->data))
            return response()->json($data);

        // If user has recieved 0 requests return 204
        return response()->json($data, 204);
    }

    /**
     * Fetch all pending send friend requests
     * @param Request $request
    */
    public function pendingSentRequests(Request $request)
    {
        $data = $request->user()->friendSent()
            ->select('id', 'user_two', 'created_at')
            ->where('status', 'pending')
            ->with($this->withReceiver)
            ->orderBy('id', 'desc')
            ->paginate();

        $data = json_encode($data);
        $data = json_decode($data);

        if(!empty($data->data))
            return response()->json($data);

        // If user has sent 0 requests return 204
        return response()->json($data, 204);
    }

    /**
     * Accept a friend request
     * Update status column to 'friends'
     * @param Request $request
     * @param int $rowId (Primary key of a FriendList row)
    */
    public function update(Request $request, $rowId)
    {
        // Get the user id who made the request
        $authID = $request->user()->id;

        // Check if friend request exist
        $data = FriendList::
                where('id', $rowId)
                ->where('user_two', $authID)
                ->where('status', 'pending')
                ->exists();

        if($data)
        {
            $update = FriendList::
                where('user_two', $authID)
                ->where('id', $rowId)
                ->update(['status' => 'friends']);

            return response()->json(['message' => 'Request accepted'], 200);
        }

        return response()->json(['message' => 'Request not found'], 404);
    }

    /**
     * This will add a new friend request
     * @param Request $request
    */
    public function store(Request $request)
    {
        if(!$request->id)
            return response()->json('No data', 403);

        // The id to be requested to be a friend
        $id = $request->id;

        // Get the user id who made the request
        $authID = $request->user()->id;

        // Checks if the user to be added exists
        $userToAdd = User::findOrFail($id);

        // Checks if the user added him/her self
        if($authID == $id)
            return response()->json(['message' => 'You cannot add yourself'], 403);

        // Checks if the user already sent a request for this user
        // Or checks if already friend with this user
        $friendCheck = FriendList::
            whereIn('user_one', [$authID, $id])
            ->whereIn('user_two', [$authID, $id])
            ->exists();

        if(!$friendCheck){
            $toData = [
                'user_one' => $authID,
                'user_two' => $id
            ];
            $data = FriendList::create($toData);

            // Send notification to the requested user realtime, Handled by Laravel Echo
            broadcast(new NewFriendRequest($data))->toOthers();

            return response()->json($data, 201);
        }

        return response()->json(['message' => 'Request pending or already friends with this user'], 403);
    }

    /**
     * Fetch how many friend request the user have
     * @param Request $request
    */
    public function pendingRequestCount(Request $request)
    {
        $userID = $request->user()->id;

        $data = FriendList::where('user_two', $userID)
            ->where('status', 'pending')
            ->count();

        return response()->json($data);
    }

    /**
     * Used to fetch friend suggestions/recommendations for the authenticated user
     * @param Request $request
     */
    public function friendSuggestions(Request $request)
    {
        // Get the user id who made the request
        $authID = $request->user()->id;

        // Queries for users that is not a friend of the current user
        // We use the use function here because "Closures has there own local scope they dont see outer variables"
        // Reference: https://laravel.io/forum/02-27-2014-the-variable-loses-its-value-inside-the-sql-query-in-eloquent-a-matter-of-scope
        $data = User::whereNotExists(function ($query) use($authID)
            {
                $query->select(DB::raw(1))
                        ->from('friend_list')
                        ->whereRaw("friend_list.user_one = users.id AND friend_list.user_two = $authID")
                        ->orWhereRaw("friend_list.user_two = users.id AND friend_list.user_one = $authID");
            })
            ->where('id', '<>', $authID)
            ->inRandomOrder()
            ->limit(20)
            ->get();

        if($data)
            return response()->json($data);
        else
            return response()->json([], 204);
    }

    /**
     * Delete/decline friend request
     * When a friend request is declined/deleted, it will be deleted in the storage
     *
     * @param Request $request
     * @param $id (Primary key of FriendList to be deleted)
    */
    public function destroy(Request $request, $id)
    {
        // Get the user id who made the request
        $authID = $request->user()->id;

        // Checks if the friend record exists
        $checkExists = FriendList::findOrFail($id);

        // Check if the user is either the requestor or the requested user
        if($checkExists->user_one == $authID || $checkExists->user_two == $authID)
            $checkExists->delete();

        return response()->json([], 204);
    }
}
