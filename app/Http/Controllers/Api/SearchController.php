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
    public function searchUserSpecific(SearchUser $data)
    {
        $toSearch = $data->validated()['q'];
        $toSearch = strtolower($toSearch);

        $data = User::select('id','name','created_at')
                    ->where('name','like','%'.$toSearch.'%')
                    ->orWhere('email','like','%'.$toSearch.'%')
                    ->paginate();

        return response()->json($data);
    }
}
