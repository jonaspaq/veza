<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SearchUser;
use App\User;

class SearchController extends Controller
{
    /**
     * Search for a user
     *
     * @param $data
     * $data is the get query
     *
     * @return array of User::class
     * paginated data of users
     */
    public function searchUser(SearchUser $data)
    {
        // $validatedData = $data->validate([
        //     'data' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        // ]);

        return response()->json($data);
    }
}
