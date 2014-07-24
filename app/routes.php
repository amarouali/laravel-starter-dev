<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');



/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');


/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin','before'=>'auth|admin'), function()
{

    # User Management
    Route::get('users/{user}/edit', ['as'=>'admin.users.edit','uses'=>'AdminUsersController@getEdit']);
    Route::put('users/{user}/edit',	['before'=>'csrf','as'=>'admin.users.update','uses'=>'AdminUsersController@putEdit']);
    Route::post('users/{user}/delete',['before'=>'csrf', 'as'=>'admin.users.delete','uses'=>'AdminUsersController@postDelete']);
    Route::controller('users', 'AdminUsersController');

        # User Management
    Route::get('roles/{role}/edit', ['as'=>'admin.roles.edit','uses'=>'AdminRolesController@getEdit']);
    Route::put('roles/{role}/edit',	['before'=>'csrf','as'=>'admin.roles.update','uses'=>'AdminRolesController@putEdit']);
    Route::post('roles/{role}/delete',['before'=>'csrf', 'as'=>'admin.roles.delete','uses'=>'AdminRolesController@postDelete']);
    Route::controller('roles', 'AdminRolesController');

    Route::get('/', ['as'=>'admin.dashboard', 'uses'=>'AdminDashboardController@getIndex']);


});

Route::get('/',['as'=>'home','uses'=>'HomeController@index']);

/*users login*/
Route::get('login',['as'=>'login','uses'=>'UsersController@login']);
Route::post('login',['as'=>'login','before'=>'csrf','uses'=>'UsersController@login']);
Route::get('logout',['as'=>'logout','uses'=>'UsersController@logout']);
Route::get('signup',['as'=>'signup','uses'=>'UsersController@signup']);
Route::post('signup',['as'=>'signup','uses'=>'UsersController@signup']);
Route::get('profil',['as'=>'profil','before'=>'auth','uses'=>'UsersController@profil']);
Route::put('profil',['as'=>'profil','before'=>'auth|csrf','uses'=>'UsersController@profil']);

/*Reset Password*/

Route::controller('password', 'RemindersController');
Route::get('mot-de-passe-oublie', ['as'=>'remind', 'uses'=>'RemindersController@getRemind']);
