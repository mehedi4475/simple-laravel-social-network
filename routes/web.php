<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'web'], function () {
    Route::get('/', function (){
        return view('welcome');
    });

    Route::post('/signup', [
        'uses'  => 'UserController@postSignUp',
        'as'    => 'signup'
    ]);

    Route::post('/signin', [
        'uses'  => 'UserController@postSignIn',
        'as'    => 'signin'
    ]);

    Route::get('/signout', [
        'uses'  => 'UserController@postSignOut',
        'as'    => 'signout'
    ]);

    Route::get('/account', [
        'uses'  => 'UserController@getAccount',
        'as'    => 'account'
    ]);

    Route::post('/updateaccount', [
        'uses'  => 'UserController@postSaveAccount',
        'as'    => 'account.save'
    ]);

    Route::get('/userimage/{filename}', [
        'uses'  => 'UserController@getUserImage',
        'as'    => 'account.image'
    ]);
    
    Route::get('/dashboard', [
        'uses'  => 'UserController@getDashboard',
        'as'    => 'dashboard',
        'middleware'    => 'auth'
    ]);
    
    Route::post('/createpost', [
        'uses'  => 'PostController@postCreatePost',
        'as'    => 'post.create',
        'middleware'    => 'auth'
    ]);
    
    Route::post('/delete-post', [
        'uses'  => 'PostController@getDeletePost',
        'as'    => 'post.delete',
        'middleware'    => 'auth'
    ]);

    Route::post('/edit', [
        'uses'  => 'PostController@postEditPost',
        'as'    => 'edit'
    ]);
    
    
    Route::post('/like', [
        'uses'  => 'PostController@postLikePost',
        'as'    => 'like'
    ]);
    
    

});