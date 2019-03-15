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

//route for backend cms
Route::group(['middleware' => 'disablepreventback'],function()
{
	Route::get('/','LoginController@index')->name('cmslogin');
	Route::get('/login', ['as' => 'admin_users.login', 'uses' => 'LoginController@getadminLogin']);
	Route::post('/login', ['as' => 'admin_users.auth', 'uses' => 'LoginController@adminAuth']);
	Route::get('/managerSignup','SignupController@managerSignUp')->name('managerSignup');
	Route::get('/emailVerification/{userid}','SignupController@emailverification')->name('emailVerification');
	Route::post('/checkVerifyCode','SignupController@checkverifycode')->name('checkVerifyCode');
	Route::post('/resendCode','SignupController@resendcode')->name('resendCode');
	Route::post('/storeUserDetail','SignupController@storeUserDetail')->name('storeUserDetail');
	Route::post('/userForgotPassword','SignupController@forgotpassword')->name('userForgotPassword');
	Route::get('/admin','LoginController@admin')->middleware(guest::class);
	Route::get('/dashboard','UserController@dashboard')->name('dashboard')->middleware(guest::class);
	Route::get('/users','UserController@index')->middleware(guest::class);
	Route::get('/adminuser','UserController@adminuser')->middleware(guest::class);
	Route::any('dashboard/user/{id}/{status}', 'UserController@approveduser')->middleware(guest::class);
	Route::any('project/bid/{projectid}/{userid}/{status}', 'ProjectController@bidaccept')->middleware(guest::class);
	Route::any('user/{status}', 'UserController@search')->middleware(guest::class);
	Route::get('/projects/{id}','ProjectController@show')->middleware(guest::class);
	Route::get('/projectBid/{id}','ProjectController@projectbid')->middleware(guest::class);
	Route::any('/setSettings','ProjectController@settings')->middleware(guest::class);
	Route::any('/saveproject','ProjectController@store')->middleware(guest::class);
	Route::any('/changeSettings','ProjectController@changesetting')->middleware(guest::class);
	Route::any('/projectList','ProjectController@managerprojects')->name('projectList')->middleware(guest::class);
	Route::get('/logout','LoginController@logout');
	Route::get('/setaddress', 'ProjectController@setaddress')->name('setaddress')->middleware(guest::class);
	Route::any('users/user/{id}/{status}', 'UserController@blockUnblockUser')->middleware(guest::class);
	Route::get('/allProjects', 'ProjectController@showProjects')->name('allProjects')->middleware(guest::class);
	Route::get('/allProejcts/bid/{projectid}/{userid}/{status}', 'ProjectController@bidacceptreject')->name('bidAcceptReject')->middleware(guest::class);
	Route::get('/createProject', 'ProjectController@create')->name('createProject')->middleware(guest::class);
	Route::get('/editProject/{id}', 'ProjectController@edit')->name('editProject')->middleware(guest::class);
	Route::put('/updateProject/{id}', 'ProjectController@update')->middleware(guest::class);
	Route::any('/projectAllocate/{id}', 'ProjectController@managerList')->name('projectAllocate')->middleware(guest::class);
	Route::get('/managerDashboard', 'UserController@managerDashboard')->name('managerDashboard')->middleware(guest::class);
	Route::get('/allProejcts/projectDetail/{id}', 'ProjectController@projectDetail')->middleware(guest::class);
	Route::get('/projectStatus/{id}', 'ProjectController@projectstatus')->middleware(guest::class);
	Route::get('/allProejcts/projectOnHold/{id}', 'ProjectController@projectOnHold')->middleware(guest::class);
	Route::get('/allProejcts/projectInProgress/{id}', 'ProjectController@projectInProgress')->middleware(guest::class);
	/*Route::get('/allProejcts/projectComplete', 'ProjectController@projectComplete')->
	name('projectComplete')->middleware(guest::class);*/
	Route::get('/allProejcts/projectComplete/{id}', 'ProjectController@projectComplete')->middleware(guest::class);
	Route::get('/allProejcts/projectCancel/{id}', 'ProjectController@projectCancel')->middleware(guest::class);
	Route::get('/editUser', 'UserController@edituser')->name('editUser')->middleware(guest::class);
	Route::post('/updateUser', 'UserController@update')->name('updateUser')->middleware(guest::class);
	Route::post('/userChangePassword', 'UserController@changepassword')->name('userChangePassword')->middleware(guest::class);
	Route::get('/rating','UserReviewController@rating')->name('rating')->middleware(guest::class);
	Route::get('/allProjects/viewStatus','ProjectController@viewStatus')->name('view-Status')->middleware(guest::class);
	Route::get('/allProjects/statusPagination','ProjectController@statusPagination')->name('status-Pagination')->middleware(guest::class);
	Route::get('/allProjects/associateList','ProjectController@associateUserList')->name('associateList')->middleware(guest::class);
	Route::get('/allProjects/searchAssociate','ProjectController@searchAssociate')->name('searchAssociate')->middleware(guest::class);
	Route::get('/allProjects/projectAssociate','ProjectController@projectAssociate')->name('projectAssociate')->middleware(guest::class);
	Route::post('/allProjects/addStatus','ProjectController@addStatus')->name('managerAddStatus')->middleware(guest::class);
	Route::get('/pendingBids/{projectid}','ProjectController@pendingBids')->name('pendingBids')->middleware(guest::class);
	Route::get('/allProjects/managerReviewStore','UserReviewController@managerReviewStore')
	->name('managerReviewStore')->middleware(guest::class);
	Route::get('/allProjects/getAssociatesName','ProjectController@getAssociatesName')->name('getAssociatesName')->middleware(guest::class);
	Route::get('/getAssociatesProfile','ProjectController@getAssociatesProfile')->name('getAssociatesProfile')->middleware(guest::class);
	Route::get('/schedulingProject/{id}','ProjectController@schedulingProject')
							->middleware(guest::class);
	Route::get('/schedulingNotification','ProjectController@schedulingNotification')->name('schedulingNotification')->middleware(guest::class);
	Route::get('/rejectLiveUser','ProjectController@rejectLiveUser')
		->name('rejectLiveUser')->middleware(guest::class);
	Route::get('/getLiveUserList','ProjectController@getLiveUserList')->name('getLiveUserList')->middleware(guest::class);
	Route::get('/changeCheckStatus','ProjectController@changeCheckStatus')->name('changeCheckStatus')->middleware(guest::class);
	Route::get('/sendProjectNotification','ProjectController@sendProjectNotification')->name('sendProjectNotification')->middleware(guest::class);
	Route::get('/archiveProjects','ProjectController@archiveProjects')->name('archiveProjects')->middleware(guest::class);
	Route::get('/archiveProjects/archive/{id}','ProjectController@archive')->name('archive')->middleware(guest::class);
	Route::get('/archiveProjects/batchArchive/','ProjectController@batchArchive')->name('batchArchive')->middleware(guest::class);
	Route::get('/dashboard/scheduled/{id}','ProjectController@scheduled')->name('scheduled')->middleware(guest::class);
	Route::get('/dashboard/batchScheduled/','ProjectController@batchScheduled')->name('batchScheduled')->middleware(guest::class);
	Route::get('/report/','ReportController@index')->name('viewReport')->middleware(guest::class);
	Route::get('/getScheduledProjects/','ReportController@getScheduledProjects')->name('getScheduledProjects')->middleware(guest::class);
});
Route::get('/forgotPassword/{userid}','LoginController@forgotpassword')->name('forgotPassword');
Route::post('/changepassword','LoginController@changepassword');
// Route for front view
Route::get('/setNewPassword/{userid}','UserController@setNewPassword')->name('setNewPassword');
Route::post('/updateNewPassword','UserController@updateNewPassword')->name('updateNewPassword');
Route::get('/home','FrontController\HomeController@index')->name('home');
Route::get('/aboutus','FrontController\HomeController@aboutus')->name('aboutus');
Route::get('/howitworks','FrontController\HomeController@howitworks')->name('howitworks');
Route::get('/contactus','FrontController\HomeController@contactus')->name('contactus');
Route::get('/home/login','FrontController\LoginController@index')->name('AssociateLogin');
Route::get('/home/signUp','FrontController\SignupController@index')->name('signUp');
Route::post('/home/register','FrontController\SignupController@register')->name('register');
Route::get('/home/emailVerify','SignupController@emailverification')->name('emailVerify');
Route::post('/home/associateLogin','FrontController\LoginController@login')->name('checkLogin');
Route::get('/home/forgotPassword','FrontController\LoginController@forgotPassword')->name('ForgotPassword');
Route::group(['middleware' => 'disablepreventback'],function()
{
	Route::get('/home/dashboard','FrontController\LoginController@dashboard')->name('associateDashboard')->middleware(IsAssociate::class);
	Route::get('/home/projects','FrontController\ProjectController@index')
	->name('associateProjects')->middleware(IsAssociate::class);
Route::get('/home/jobFinder','FrontController\ProjectController@projectbids')->name('jobFinder')->middleware(IsAssociate::class);
Route::get('/home/myProfile','FrontController\UserController@edit')->name('associateProfile')->middleware(IsAssociate::class);
Route::post('/home/updateProfile','FrontController\UserController@update')->name('updateProfile')->middleware(IsAssociate::class);
Route::post('/home/updatePassword','FrontController\UserController@updatePassword')->name('update_password')->middleware(IsAssociate::class);
Route::get('/home/logout','FrontController\LoginController@logout')->name('AssociateLogout')
		->middleware(IsAssociate::class);
Route::get('/home/projectdetail','FrontController\ProjectController@show')
		->name('projectDetails')->middleware(IsAssociate::class);
Route::get('/home/viewManagerProfile','FrontController\ProjectController@viewManagerProfile')
		->name('viewManagerProfile')->middleware(IsAssociate::class);
Route::get('/home/applyBid','FrontController\ProjectController@applyBid')->name('applyBid')
		->middleware(IsAssociate::class);
Route::get('/home/viewStatus','FrontController\ProjectController@viewStatus')->name('viewStatus')->middleware(IsAssociate::class);
Route::post('/home/addStatus','FrontController\ProjectController@addStatus')->name('addStatus')->middleware(IsAssociate::class);
Route::get('/home/readNotification','FrontController\ProjectController@readNotification')->name('readNotification')->middleware(IsAssociate::class);
Route::get('/home/searchProject','FrontController\ProjectController@searchProject')
		->name('searchProject')->middleware(IsAssociate::class);
Route::get('/home/searchProjectHistory','FrontController\ProjectController@searchProjectHistory')->name('searchProjectHistory')->middleware(IsAssociate::class);
Route::get('/home/getSettings','FrontController\ProjectController@getSettings')->name('getSettings')->middleware(IsAssociate::class);
Route::get('/home/updateSettings','FrontController\ProjectController@updateSettings')->name('updateSettings')->middleware(IsAssociate::class);
Route::get('/home/projectPagination','FrontController\ProjectController@loadAvailableProject')->name('projectPagination')->middleware(IsAssociate::class);
Route::get('/home/loadInProgressProject','FrontController\ProjectController@loadInProgressProject')->name('loadInProgressProject')->middleware(IsAssociate::class);
Route::get('/home/notificationPagination','FrontController\LoginController@notificationPagination')->name('notificationPagination')->middleware(IsAssociate::class);
Route::get('/home/userReviewPagination','FrontController\UserController@userReviewPagination')->name('userReviewPagination')->middleware(IsAssociate::class);
Route::get('/home/statusPagination','FrontController\ProjectController@statusPagination')->name('statusPagination')->middleware(IsAssociate::class);
Route::get('/home/historyPagination','FrontController\ProjectController@historyPagination')->name('historyPagination')->middleware(IsAssociate::class);
Route::get('/home/projectInfo','FrontController\ProjectController@projectInfo')->name('projectInfo')->middleware(IsAssociate::class);
Route::get('/home/acceptProject','FrontController\ProjectController@acceptProject')->name('acceptProject')->middleware(IsAssociate::class);
Route::get('/home/declineProject','FrontController\ProjectController@declineProject')->name('declineProject')->middleware(IsAssociate::class);
Route::get('/home/myBids','FrontController\MybidController@index')->name('myBids')->middleware(IsAssociate::class);
Route::get('/home/searchBidHistory','FrontController\MybidController@searchBidHistory')->name('searchBidHistory')->middleware(IsAssociate::class);
Route::get('/home/searchActiveBids','FrontController\MybidController@searchActiveBids')->name('searchActiveBids')->middleware(IsAssociate::class);
Route::get('/home/activeBidPagination','FrontController\MybidController@activeBidPagination')->name('activeBidPagination')->middleware(IsAssociate::class);
Route::get('/home/associateReviewStore','UserReviewController@associateReviewStore')->name('associateReviewStore')->middleware(IsAssociate::class);

});

//Reoptimized class loader: 
Route::get('/optimize', function() {
   $exitCode = Artisan::call('optimize');
   return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
   $exitCode = Artisan::call('route:cache');
   return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
   $exitCode = Artisan::call('route:clear');
   return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
   $exitCode = Artisan::call('view:clear');
   return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
   $exitCode = Artisan::call('config:cache');
   return '<h1>Clear Config cleared</h1>';
});

Route::get('/clear-cache', function() {
   $exitCode = Artisan::call('cache:clear');
   return '<h1>Cache facade value cleared</h1>';
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
