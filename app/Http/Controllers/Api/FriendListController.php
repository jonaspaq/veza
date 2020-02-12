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
                ->with('sender:id,name,email', 'receiver:id,name,email')
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
            ->with('sender:id,name,email')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return response()->json($data);
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
            ->with('receiver:id,name,email')
            ->orderBy('id', 'desc')
            ->paginate();

        return response()->json($data);
    }

    /**
     * Accept a friend request
     * Set status column to 'friends'
     * @param Request $request
    */
    public function update(Request $request)
    {
        $toBeAcceptedID = $request->id;

        // Get the user id who made the request
        $authID = $request->user()->id;

        // Check if friend request exist
        $data = FriendList::
                where('id', $toBeAcceptedID)
                ->where('user_two', $authID)
                ->where('status', 'pending')
                ->get();

        if($data)
        {
            $update = FriendList::
                where('user_two', $authID)
                ->where('id', $toBeAcceptedID)
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
     * @param $id 
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
