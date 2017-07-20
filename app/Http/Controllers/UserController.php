<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{
    
    /* Dashboard */
    public function getDashboard(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard')->with(['posts' => $posts]);
    }
    
    
    /* Sign Up */
    public function postSignUp(Request $request){
        
        $this->validate($request, [
            'email'         => 'required | email | unique:users',
            'first_name'    => 'required | max:120',
            'password'      => 'required | min:4'
        ]);
        
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);
        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;
        $user->save();
        return redirect()->route('dashboard');
    }
    
    
    /* Sign In */
    public function postSignIn(Request $request){
        
        
        $this->validate($request, [
            'email'         => 'required',
            'password'      => 'required'
        ]);
        
        
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }
    
    
    
    /* Sign Out */
    public function postSignOut(){
        
        Auth::logout();
       
        return redirect('/');
    }
    
    
    /* User account image */
    
    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
    
    
    
    /* Account */
    
    public function getAccount(){
        return view('account', ['user' => Auth::user()]);
    }
    
    
    
   
    /* Account Info Update */
    
    public function postSaveAccount(Request $request){
        $this->validate($request, [
            'first_name'    => 'required | max:120'
        ]);
        $user = Auth::user();
        $user->first_name = $request['first_name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['first_name']. '-' . $user->id . '.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}