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

/*Route::get('/', function () {
    return view('welcome');
});
*/

     // uses 'auth' middleware


Route::group(['middleware' => 'disablepreventback'],function()
{
	Route::get('/','LoginController@index');

	Route::get('/login', ['as' => 'admin_users.login', 'uses' => 'LoginController@getadminLogin']);
	Route::post('/login', ['as' => 'admin_users.auth', 'uses' => 'LoginController@adminAuth']);
	Route::get('/admin','LoginController@admin')->middleware(guest::class);
	Route::get('/dashboard','UserController@dashboard')->middleware(guest::class);
	Route::get('/users','UserController@index')->middleware(guest::class);
	Route::get('/adminuser','UserController@adminuser')->middleware(guest::class);
	Route::any('dashboard/user/{id}/{status}', 'UserController@approveduser')->middleware(guest::class);
	Route::any('user/{status}', 'UserController@search')->middleware(guest::class);
	Route::get('/projects/{id}','ProjectController@show')->middleware(guest::class);
	Route::get('/logout','LoginController@logout');
});
//Route::get('/logout','LoginController@logout');
//});

/*Route::get('/admin/login',function()
{
	return view('login');
});*/
//Auth::routes();
/*Route::any('users/login', 'Front\UsersController@login')->name('userlogin');*/
//Route::get('/home', 'HomeController@index')->middleware('guest');
