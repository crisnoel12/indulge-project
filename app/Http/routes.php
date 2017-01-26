<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    /**
     * Base Routes
     */
    Route::auth();
    Route::get('/', 'WelcomeController@index');
    Route::get('/home', 'HomeController@index');
	  Route::get('/search', 'HomeController@getSearch');

    /**
     * Profile Routes
     */
	Route::get('/user/{username}', [
		'uses' => 'ProfileController@getProfile',
		'as' => 'profile.index'
	]);
	Route::get('/profile/edit', [
		'uses' => 'ProfileController@getEdit'
	]);
	Route::post('/profile/edit', [
		'uses' => 'ProfileController@postEdit'
	]);
    Route::post('/upload-profile-picture', [
		'uses' => 'ProfileController@uploadProfilePicture'
	]);
    Route::get('/profile/change-password', [
		'uses' => 'ProfileController@getChangePassword'
	]);
    Route::post('/profile/change-password', [
		'uses' => 'ProfileController@postChangePassword'
	]);
    /**
     * Friends Route
     */
	Route::get('/friends', [
		'uses' => 'friendController@getIndex'
	]);
	Route::get('/user/add/{id}', [
		'uses' => 'friendController@getAdd'
	]);
	Route::get('/user/accept/{id}', [
		'uses' => 'FriendController@getAccept'
	]);

    /**
     * User's Post/Comment/Like Routes
     */
    Route::post('/post', [
		'uses' => 'PostController@post'
    ]);
    Route::delete('/post/{id}', [
		'uses' => 'PostController@destroy'
    ]);
    Route::post('/post/comment/{postId}', [
		'uses' => 'PostController@postComment'
    ]);
    Route::get('/post/like/{postId}', [
		'uses' => 'PostController@getLike'
    ]);

    /**
     * Messages Route
     */
    Route::get('/messages', [
        'uses' => 'ConversationController@getConversations'
    ]);
    Route::post('/messages/post/{id}', [
        'uses' => 'ConversationController@postMessage'
    ]);
    Route::post('/conversation/post/{id}', [
        'uses' => 'ConversationController@postToConversation'
    ]);
});
