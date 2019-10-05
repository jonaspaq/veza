<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\Posts;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->user();
        $data = Post::where('user_id', $request->user()->id)
                ->with('user:id,name')
                ->orderBy('id', 'desc')
                ->get(); 
        $count = count($data);

        if( $count >= 1 ){
            return response()->json($data, 200);
        }else{
            return response()->json(['message' => 'No posts yet!'], 404);
        }

        // return $request->user()->token();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts $request)
    {
        // return $request->user();
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $dataInsert = Post::create($data);
        $newData = Post::where('id', $dataInsert->id)->with('user:id,name')->first();

        if($newData){
            return response()->json(['message' => 'Successfully Posted', 'data' => $newData], 201);
        }else{
            return response()->json(['message' => 'Something went wrong'], 400);
        }
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

        if($data){
            return response()->json($data, 200);
        }else{
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Posts $request, $id)
    {
        //Warning! when using this function please add (_method: PUT) in parameters of http request
        $dataUpdate = $request->validated();

        // Checks if post exist
        $presentData = Post::find($id);
        if(!$presentData){
            return response()->json(['message' => 'Post not found'], 404);
        }elseif($presentData->user_id != $request->user()->id){ //Check if user is the owner of the post
            return response()->json(['message' => 'User unauthorized'], 401);
        }

        $presentData->update($dataUpdate);

        if($presentData){
            return response()->json(['message' => 'Successful Updating Post', 'data' => $presentData], 200);
        }
        else{
            return reponse()->json(['message' => 'Post not found or user unauthorized'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $user = $request->user();
    
        // Check if the user requested to delete is the owner of the post
        $authorize = Post::where('user_id', $user->id)->where('id', $id)->first();

        // If $authorize is true or if user is an admin continue with post deletion
        if($authorize || $user->user_type == 'admin'){
            $delete = Post::where('id', $id)->delete();
            if($delete==1){
                return response()->json(['message' => 'Successfully Deleted'], 200);
            }
        }

        return response()->json(['message' => 'Error, post not found or user unauthorized'], 401);

    }
}
