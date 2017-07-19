<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller{
    
    /* Post Create */
    
    public function postCreatePost(Request $request){

        //Validation
        $this->validate($request, [
           'body'   => 'required | min:15 | max:1000' 
        ]);
        
        
        $post = new Post();
        $post->body = $request['body'];
        $message = "Not Successfully Insert";
        if($request->user()->posts()->save($post)){
            $message = "Successfully Insert";
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
    
    
    
    /* Delete Post */
    
    public function getDeletePost($post_id){
        
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            
        }
        $message = 'Not Successfully Delete';
        if($post->delete()){
            $message = 'Successfully Delete';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
    
    
    
    
    /* Post Edit */
    
    function postEditPost(Request $request){
        $this->validate($request, [
            'body'  => 'required'
        ]);
        
        $post = Post::find($request['postId']);
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


