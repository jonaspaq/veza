<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\Posts;

class PostController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Post::where('user_id', $request->user()->id)
                ->with('user:id,name')
                ->orderBy('id', 'desc')
                ->get(); 

        if( count($data) >= 1 )
            return response()->json($data, 200);
        
        return response()->json(['message' => 'No posts yet'], 204);
    }

    /**
     * Store a newly created post.
     *
     * @param  App\Post $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $dataInsert = Post::create($data);
        $newData = Post::where('id', $dataInsert->id)->with('user:id,name')->first();
    
        if($newData)
            return response()->json(['message' => 'Successfully Posted', 'data' => $newData], 201);
        
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::where('id', $id)->with('user:id,name')->first();

        if($data)
            return response()->json($data, 200);
        
        return response()->json(['message' => 'Post not found'], 404);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Post $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Posts $request, $id)
    {
        //Warning! when using this function please add (_method: PUT or PATCH) in parameters of http request
        $dataUpdate = $request->validated();

        // Checks if post exist
        $presentData = Post::findOrFail($id);
        
        //Check if user is the owner of the post
        if($presentData->user_id != $request->user()->id) 
            return response()->json(['message' => 'User unauthorized'], 401);

        $presentData->update($dataUpdate);

        $updatedData = Post::where('id', $presentData->id)->with('user:id,name')->first();

        if($updatedData)
            return response()->json(['message' => 'Successful Updating Post', 'data' => $updatedData], 200);
        
        return reponse()->json(['message' => 'Post not found or user unauthorized'], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $user = $request->user();
    
        // Check if the user that requested to delete is the owner of the post
        $authorize = Post::where('user_id', $user->id)->where('id', $id)->first();

        // If $authorize is true or if user is an admin continue with post deletion
        if($authorize || $user->user_type == 'admin'){
            $delete = Post::where('id', $id)->delete();
            if($delete==1)
                return response()->json(['message' => 'Successfully Deleted'], 200);
        }

        return response()->json(['message' => 'Error, post not found or user unauthorized'], 400);
    }
}
