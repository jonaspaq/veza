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
     * @param SearchUser::class $data
     * @return array of User::class
     */
    public function searchUser(SearchUser $data)
    {
        return $data;
    }
}
