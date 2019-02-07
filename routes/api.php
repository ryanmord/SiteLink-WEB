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
Route::any('/testpushnotification', 'ApiController@testpushnotification');
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
Route::any('/projectDetail', 'ApiController@projectDetail');
Route::any('/projectHistory', 'ApiController@projectHistory');
Route::any('/associateProfile', 'ApiController@associateprofile');
Route::any('/viewProfile', 'ApiController@viewProfile');
Route::any('/viewUserReview', 'ApiController@viewUserReview');
Route::any('/updateProject', 'ApiController@updateProject');
Route::any('/inprogressStatus', 'ApiController@inprogressStatus');
Route::any('/storeuserReview', 'ApiController@storeuserReview');
Route::any('/getMilesValue', 'ApiController@getMilesValue');
Route::any('/viewBids', 'ApiController@viewBids');
Route::any('/inProgessProject', 'ApiController@inProgessProject');
Route::any('/addStatus', 'ApiController@addStatus');
Route::any('/myBids', 'ApiController@myBids');
Route::any('/bidRequest', 'ApiController@bidrequest');
Route::any('/projectComplete', 'ApiController@projectComplete');
Route::any('/projectCancel', 'ApiController@projectCancel');
Route::any('/availableProject', 'ApiController@availableProject');
Route::any('/associateProfile', 'ApiController@associateProfile');
Route::any('/notificationList', 'ApiController@notificationList');
Route::any('/readNotification', 'ApiController@readNotification');
Route::any('/projectOnHold', 'ApiController@projectOnHold');
Route::any('/mapAvailableProject', 'ApiController@mapAvailableProject');
Route::any('/webpushnotification', 'ApiController@webpushnotification');
Route::any('/getStatusType', 'ApiController@getStatusType');
Route::any('/acceptProject', 'ApiController@acceptProject');
Route::any('/declineProject', 'ApiController@declineProject');
Route::any('/activeBids','ApiController@activeBids');
Route::any('/bidHistory','ApiController@bidHistory');
Route::any('/getLAtLong','ApiController@getLAtLong');
Route::any('/apiGeneratedToken','ApiController@apiGeneratedToken');
