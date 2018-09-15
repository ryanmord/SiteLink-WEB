<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('/userSignup', 'ApiController@signup');
Route::any('/userLogin', 'ApiController@userlogin');
Route::any('/dashboard', 'ApiController@dashboard');
Route::any('/scopeperformed', 'ApiController@scopeperformed');
Route::any('/emailverification', 'ApiController@emailverification');
Route::any('/resendEmail', 'ApiController@resendemail');
Route::any('/changePassword', 'ApiController@changepassword');
Route::any('/getProfile', 'ApiController@getprofile');
Route::any('/updateProfile', 'ApiController@updateProfile');
Route::any('/updateSettings', 'ApiController@updateSettings');
Route::any('/getSettings', 'ApiController@getsettings');
Route::any('/forgotPassword', 'ApiController@forgotpassword');
Route::any('/createProject', 'ApiController@createProject');
Route::any('/userProfile', 'ApiController@userprofile');
Route::any('/userReview', 'ApiController@userReview');
Route::any('/userLogout', 'ApiController@logout');
Route::any('/publishProjects', 'ApiController@publishProject');
Route::any('/projectDetail', 'ApiController@projectdetail');
Route::any('/completeProject', 'ApiController@completeProject');
Route::any('/cancelProject', 'ApiController@cancelProject');