<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FriendList;
use App\Events\NewFriendRequest;
use Auth;
use DB;

class FriendListController extends Controller
{
    /**
     *  Used to fetch friend suggestions/recommendations for the authenticated user
     */
    public function friendSuggestions()
    {  
        // Queries for users that is not a friend of the current user
        $data = User::whereNotExists(function ($query) 
            {
                $query->select(DB::raw(1))
                        ->from('friend_list')
                        ->whereRaw('friend_list.user_one = users.id AND friend_list.user_two ='.Auth::id())
                        ->orWhereRaw('friend_list.user_two = users.id AND friend_list.user_one ='.Auth::id());
            })
            ->where('id', '<>', Auth::id())
            ->inRandomOrder()
            ->limit(20)
            ->get();
            
        if($data) 
            return response()->json($data);
        else 
            return response()->json([], 204);  
    }


    /**
     * Function fired when adding a friend
    */
    public function addFriend(Request $request, $id)
    {
        $authID = $request->user()->id;

        // Checks if the user added him/her self
        if($authID == $id)
            return response()->json(['message' => 'You cannot add yourself'], 400);

        // Checks if the user already sent a request for this user
        // Or checks if already friend with this user
        $friendCheck = FriendList::
            whereIn('user_one', [$authID, $id])
            ->whereIn('user_two', [$authID, $id])
            ->first();
        
        if(!$friendCheck){
            $toData = [
                'user_one' => $authID,
                'user_two' => $id
            ];
            $data = FriendList::create($toData);

            // Send notification to the requested user realtime
            broadcast(new NewFriendRequest($data))->toOthers();

            return response()->json($data, 201);
        }else
            return response()->json(['message' => 'Request pending or already friends with this user'], 400);
    }
}
