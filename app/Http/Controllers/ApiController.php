<?php
namespace App\Http\Controllers;
use App\User;
use App\UserScopePerformed;
use App\ScopePerformed;
use App\UserDevice;
use App\UserAccessKey;
use App\Project;
use App\ProjectNotification;
use App\ProjectStatusType;
use App\ProjectBid;
use App\ProjectStatus;
use App\UserForgetPasswordRequest;
use App\UserReview;
use App\ProjectProgressStatus;
use App\Setting;
use APP\ProjectBidRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Image;
use DateTime;
use App\Mail\UserRegistered;
use App\Mail\ForgotPassword;
use Mail;
use File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /*Name : User signup 
    Url  :http://103.51.153.235/project_management/public/index.php/api/userSignup?email=swatibhor@gmail.com&name=Swati&phone=123456&usertype=2&company=SS&address=Bhosari&image=&scope=1,2,3
    Date : 28-08-18
    By   : Suvarna*/
    
    public function signup(Request $request)
    {
    	$model = new User;
    	$email = $request['email'];
    	$user = User::where('users_email','=',$email)->first();
        if(isset($user))
    	{
    		echo json_encode(array('status' => '0','message' => "User already registered"));
    			exit;
    	}
    	else
    	{
    		if(isset($request['email']) && isset($request['name']) && isset($request['phone']) && isset($request['usertype']) && isset($request['company']))
    		{
    			$file = $request->file('image');
    			if(isset($file))
    			{
    				
    				$file = $request->file('image');
                    $destinationPath = public_path('img/users');
                    $image_name = time() . "-" . $file->getClientOriginalName();
                    $path = $file->move($destinationPath, $image_name);
                    //$path = "img/users/" . $image_name;
                    $model->users_profile_image = $image_name;
                }
                else 
                {
                    $path = "default.png";
                    $model->users_profile_image = $path;
                }
				$password = str_random(8);
 				$model->users_email = $request['email'];
    			$model->user_types_id = (int)$request['usertype'];
    			$model->users_name = $request['name'];
    			$model->users_company = $request['company'];
    		    $model->users_password = Hash::make($password);
                $model->users_phone = $request['phone'];
    			if(isset($request['address']))
    			{
    				$model->users_address = $request['address'];
    			}
    			else
    			{
    				$model->users_address = "-";
    			}
                if(isset($request['latitude']) && isset($request['longitude']))
                {
                    $model->latitude = $request['latitude'];
                    $model->longitude = $request['longitude'];
                }
    			$model->save();
    			$user = User::where('users_email','=',$email)->first();
    			if(isset($request['scope']))
    			{
    				
    				$userid = $user->users_id;
					$scopeperformed = new UserScopePerformed;
					$scopeperformed->users_id = $userid;
					$scopeperformed->scope_performed_id = $request['scope'];
					$scopeperformed->last_updated = date('Y-m-d H:i:s');
					$scopeperformed->save();
    			}

                $action = 1;
    			Mail::to($email)->send(new UserRegistered($user,$password,$action));
    			echo json_encode(array('status' => '1','message' => "User registration successfully"));
    			exit;
			}
    		else
    		{
    			echo json_encode(array('status' => '0','message' => "Mandatory Parameter is Missing"));
    			exit;
    		}
    	}
    }
  /*Name : User login 
    Url  :http://103.51.153.235/project_management/public/index.php/api/userLogin?email=swatibhor.magneto@gmail.com&password=d2Pc8o8u&deviceid=45554&devicetype=2
    Date : 29-08-18
    By   : Suvarna*/
    public function userlogin(Request $request)
    {
        $email      = $request['email'];
        $password   = $request['password'];
        $deviceid   = $request['deviceid'];
        $devicetype = $request['devicetype'];
        $user = User::where('users_email','=',$email)->first();
        if(isset($user))
        {
           
            $emailstatus = $user->email_status;
            $usertype = $user->user_types_id;
            if($usertype == 1)
            {
                $userapprovalstatus = 1;
            }
            else
            {
                $userapprovalstatus  = $user->users_approval_status;
            }
            if($emailstatus == 1)
            {
                if($userapprovalstatus == 1)
                {
                
                    if(Hash::check($password, $user['users_password']))
                    {
                        $userid = $user->users_id;
                      
                        $username = $user->users_name;
                        $usertype = (string)$user->user_types_id;
                        $model = new  UserDevice;
                        $model->user_id = $userid;
                        $model->user_device_type = (int)$devicetype;
                        $model->user_device_unique_id = $deviceid;
                        $model->user_device_registered_on = date('Y-m-d H:i:s');
                        $model->save();
                        $device = UserDevice::where('user_id','=',$userid)
                            ->where('user_device_unique_id',$deviceid)->get();
                        foreach ($device as  $value) 
                        {
                            $userdeviceid = $value->user_device_id;
                        }
                        $accesskey  = str_random(16);
                        $userkey = new UserAccessKey;
                        $userkey->user_access_key = $accesskey;
                        $userkey->user_id = $user->users_id;
                        $userkey->user_device_id = $userdeviceid;
                        $userkey->user_access_key_status = 1;
                        $userkey->user_access_key_generated = date('Y-m-d H:i:s');
                        $userkey->logout_status = 0;
                        $userkey->save();
                        echo json_encode(array('status'  => '1',
                                        'message'    => 'User Login successfully',
                                        'privatekey' => $accesskey,
                                        'userid'     => (string)$userid,
                                        'usertype'   => $usertype,
                                        'deviceid'   => (string)$userdeviceid
                                    ));
                                      
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0','message' => "Your password is incorrect"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0','message' => "Please wait for your associate request approval"));
                        exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "Please verify your email"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "Your emailid is incorrect"));
            exit;
        }
    }
    /*Name : Dashboard
    Url  :http://103.51.153.235/project_management/public/index.php/api/dashboard
    Date : 02-09-18
    By   : Suvarna*/
    public function dashboard(Request $request)
    {
        /*if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user  = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $username = $user->users_name;
                $usertype = $user->user_types_id;
                $notificationcount = ProjectNotification::where('to_users_id','=',$userid)
                ->where('read_flag','=',0)->count();
                $profileimage = asset("/img/users/" . $user['users_profile_image']);
                if(isset($request['month']) && isset($request['year']))
                {
                    $year = $request['year'];
                    $month = $request['month'];
                    if($usertype == 1)
                    {
                        $projectcount = Project::where('user_id','=',$userid)
                            ->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)->count();
                        $bidmade = ProjectBid::where('project_bid_status','=',1)
                            ->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)->get();
                        $bidmadecount = 0;
                        foreach ($bidmade as  $value) 
                        {
                            $projectbidid = $value->project_id;
                            $model = Project::where('user_id','=',$userid)
                            ->where('project_id','=',$projectbidid)->get();
                            if(count($model)>0)
                            {
                              $bidmadecount = $bidmadecount + 1;  
                            }
                        }
                        $completedproject = Project::where('user_id','=',$userid)->get();
                        $completedprojectcount = 0;
                        foreach ($completedproject as $value) 
                        {
                            $projectid = $value->project_id;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=',4)
                            ->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)->get();
                            if(count($model)>0)
                            {
                                $completedprojectcount = $completedprojectcount + 1;
                            }
                        }
                        $overdueprojectcount = 0;
                        $project = Project::where('user_id','=',$userid)->get();
                        foreach ($project as $value) 
                        {
                            $projectid = $value->project_id;
                            $reportduedate = $value->report_due_date;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            whereYear('created_at', '<=', $year)->
                            whereMonth('created_at', '<=', $month)->
                            where('project_status_type_id','=',3)->
                            orWhere('project_status_type_id','=',2)->
                            where('created_at','>',$reportduedate)->get();
                            if(count($model) > 0)
                            {
                                $overdueprojectcount = $overdueprojectcount + 1;
                            }

                        }
                    }
                    else
                    {
                       $projectcount = ProjectBid::where('user_id','=',$userid)
                            ->where('project_bid_status','=',1)
                            ->whereYear('created_at', '<=', $year)
                            ->whereMonth('created_at', '<=', $month)->count();
                    
                        $bidmadecount = ProjectBid::where('project_bid_status','=',1)
                        ->where('user_id','=',$userid)->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)->count();
                        $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->get();
                        $completedprojectcount = 0;
                        foreach ($completedproject as $value) 
                        {
                            $projectid = $value->project_id;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=',4)
                            ->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)->get();
                            if(count($model)>0)
                            {
                                $completedprojectcount = $completedprojectcount + 1;
                            }
                        }
                        $overdueprojectcount = 0;
                        $projectbid = ProjectBid::where('user_id','=',$userid)->
                                   where('project_bid_status','=',1)->get();

                        if(count($projectbid) > 0)
                        {
                            foreach ($projectbid as $value) 
                            {
                                $projectid = $value->project_id;
                                $project = Project::where('project_id','=',$projectid)->
                                first();
                                $reportduedate = $project->report_due_date;
                                $model = ProjectStatus::where('project_id','=',$projectid)->
                                whereYear('created_at', '<=', $year)->
                                whereMonth('created_at', '<=', $month)->
                                where('project_status_type_id','=', 3)->
                                orWhere('project_status_type_id','=', 2)->
                                where('created_at','>', $reportduedate)->get();
                                if(count($model) > 0)
                                {
                                    $overdueprojectcount = $overdueprojectcount + 1;
                                }

                            }
                        }
                       
                    }
                    $projectcount = $projectcount + $overdueprojectcount;
                    echo json_encode(array('status'  => '1',
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'projectcount' => (string)$projectcount,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' =>(string)$overdueprojectcount,
                                        'notificationcount' => (string)$notificationcount));
                    exit;
                }

                else
                {
                    echo json_encode(array('status' => '0','message' => "Month and year is Mandatory"));
                    exit;
                }
               
            }
            else
            {
                 echo json_encode(array('status' => '0','message' => "Private key is not correct"));
                exit;
            }

        }
        else
        {

            echo json_encode(array('status' => '0','message' => "User Id and private key is Mandatory"));
                exit;
        }*/
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user  = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $username = $user->users_name;
                $usertype = $user->user_types_id;
                $notificationcount = ProjectNotification::where('to_user_id','=',$userid)
                ->where('read_flag','=',0)->count();
                $profileimage = asset("/img/users/" . $user['users_profile_image']);
                if($usertype == 1)
                {
                        $projectcount = Project::where('user_id','=',$userid)->count();
                        $bidmade = ProjectBid::where('project_bid_status','=',1)->get();
                        $bidmadecount = 0;
                        foreach ($bidmade as  $value) 
                        {
                            $projectbidid = $value->project_id;
                            $model = Project::where('user_id','=',$userid)
                            ->where('project_id','=',$projectbidid)->get();
                            if(count($model)>0)
                            {
                              $bidmadecount = $bidmadecount + 1;  
                            }
                        }
                        $completedproject = Project::where('user_id','=',$userid)->get();
                        $completedprojectcount = 0;
                        foreach ($completedproject as $value) 
                        {
                            $projectid = $value->project_id;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=',4)->get();
                            if(count($model)>0)
                            {
                                $completedprojectcount = $completedprojectcount + 1;
                            }
                        }
                        $overdueprojectcount = 0;
                        $project = Project::where('user_id','=',$userid)->get();
                        foreach ($project as $value) 
                        {
                            $projectid = $value->project_id;
                            $reportduedate = $value->report_due_date;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=',3)->
                            orWhere('project_status_type_id','=',2)->
                            where('created_at','>',$reportduedate)->get();
                            if(count($model) > 0)
                            {
                                $overdueprojectcount = $overdueprojectcount + 1;
                            }

                        }
                    }
                    else
                    {
                        $projectcount = ProjectBid::where('user_id','=',$userid)
                            ->where('project_bid_status','=',1)->count();
                        $bidmadecount = ProjectBid::where('project_bid_status','=',1)
                        ->where('user_id','=',$userid)->count();
                        $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->get();
                        $completedprojectcount = 0;
                        foreach ($completedproject as $value) 
                        {
                            $projectid = $value->project_id;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=',4)->get();
                            if(count($model)>0)
                            {
                                $completedprojectcount = $completedprojectcount + 1;
                            }
                        }
                        $overdueprojectcount = 0;
                        $projectbid = ProjectBid::where('user_id','=',$userid)->
                                   where('project_bid_status','=',1)->get();

                        if(count($projectbid) > 0)
                        {
                            foreach ($projectbid as $value) 
                            {
                                $projectid = $value->project_id;
                                $project = Project::where('project_id','=',$projectid)->
                                first();
                                $reportduedate = $project->report_due_date;
                                $model = ProjectStatus::where('project_id','=',$projectid)->
                                where('project_status_type_id','=', 3)->
                                orWhere('project_status_type_id','=', 2)->
                                where('created_at','>', $reportduedate)->get();
                                if(count($model) > 0)
                                {
                                    $overdueprojectcount = $overdueprojectcount + 1;
                                }

                            }
                        }
                    }
                    echo json_encode(array('status'  => '1',
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'projectcount' => (string)$projectcount,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' =>(string)$overdueprojectcount,
                                        'notificationcount' => (string)$notificationcount));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0','message' => "Private key is not correct"));
                    exit;
                }
            }
             else
            {
                echo json_encode(array('status' => '0','message' => "User Id and private key is Mandatory"));
                exit;
            }
        }
    /*Name : Scope performed
    Url  :http://103.51.153.235/project_management/public/index.php/api/scopeperformed
    Date : 29-08-18
    By   : Suvarna*/
    
    public function scopeperformed()
    {
            $scope = array();
            $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')->get();
            foreach ($scopeperformed as  $value) 
            {
                $scope[] = ['scope_performed_id' => (string)$value['scope_performed_id'], 'scope_performed' =>  $value['scope_performed']];
               
            }
            
            if(isset($scopeperformed))
            {
                echo json_encode(array('status' => '1','scopeperformed' => $scope));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "no values for scope performed"));
                exit;
            }
    }
    /*Name : email verification
    Url  :http://103.51.153.235/project_management/public/index.php/api/emailverification?email=swatibhor.magneto@gmail.com&password=254Uynv7
    Date : 29-08-18
    By   : Suvarna*/
   
    public function emailverification(Request $request) 
    {
        if(isset($request['email']))
        {
            $email = $request['email'];
            $password = $request['password'];
            $user = User::where('users_email','=',$email)->first();
            if(isset($user))
            {
                if(Hash::check($password, $user['users_password'])) 
                {
                    $flag = User::where('users_email', '=', $email)
                    ->update(['email_status' => 1]);
                    echo json_encode(array('status' => '1','message' => "email verification successfully"));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0','message' => "Password doesn't match"));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "Email Id is not correct"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "Password is Mandatory"));
            exit;
        }
        
    }
    /*Name : Resend Email 
    Url  :http://103.51.153.235/project_management/public/index.php/api/resendemail?email=swatibhor.magneto@gmail.com
    Date : 30-08-18
    By   : Suvarna*/
    public function resendemail(Request $request)
    {
        if(isset($request['email']))
        {
            $email = $request['email'];
            $user = User::where('users_email','=',$email)->first();
            if(isset($user))
            {
                $password = str_random(8);
                $hashpassword = Hash::make($password);
                $model = User::where('users_email', '=',$email)
                ->update(['users_password' => $hashpassword]);
                if(isset($model))
                {
                    $action = 1;
                    Mail::to($email)->send(new UserRegistered($user,$password,$action));
                    echo json_encode(array('status' => '1','message' => "Email resend successfully"));
                    exit;
               }    

            }
            else
            {
                echo json_encode(array('status' => '0','message' => "Email Id is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "Email Id is Mandatory"));
                exit;
        }
    }
    /*Name : Change Password 
    Url  :http://103.51.153.235/project_management/public/index.php/api/changePassword?userid=153&password=123456&privatekey=a4Pawv6B7adKxqNv
    Date : 30-08-18
    By   : Suvarna*/
    public function changepassword(Request $request)
    {
        if(isset($request['password']) && isset($request['userid']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $password = $request['password'];
            $user  = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $hashpassword = Hash::make($password);
                $model = User::where('users_id', '=',$userid)
                ->update(['users_password' => $hashpassword]);
                echo json_encode(array('status' => '1','message' => "Password changed successfully"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "password is not changed"));
                exit;
            }
        }
    }
    /*Name : Myprofile
    Url  :http://103.51.153.235/project_management/public/index.php/api/getProfile?userid=153&privatekey=z6nRHY3Gc4AzBXH0
    Date : 30-08-18
    By   : Suvarna*/
    public function getprofile(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user  = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $profileimage = asset("/img/users/" . $user['users_profile_image']);
                $name    = $user->users_name;
                $company = $user->users_company;
                $email   = $user->users_email;
                $phone   = $user->users_phone;
                if($user->user_types_id == 2)
                {
                    $address = $user->users_address;
                    $latitude = $user->latitude;
                    $longitude = $user->longitude;
                    $scopeid = DB::select(DB::raw("SELECT sp.scope_performed_id
                            FROM user_scope_performed sp,users u
                            WHERE sp.users_id = u.users_id
                            AND sp.users_id = $userid;
                            "));
                    $scope = $scopeid[0]->scope_performed_id;
                    $data = [];
                    $temp = explode(",", $scope);
                    foreach ($temp as $value) 
                    {

                        $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                         ->where('scope_performed_id','=',(int)$value)->first();
                        $data[]=['scope_performed_id' => (string)$scopeperformed->    scope_performed_id,
                       'scope_performed' => $scopeperformed->scope_performed];
                    }
                    echo json_encode(array('status'  => '1',
                                        'profileimage' => $profileimage,
                                        'name'         => $name,
                                        'company'      => $company,
                                        'email'        => $email,
                                        'phone'        => $phone,
                                        'address'      => $address,
                                        'latitude'     => $latitude,
                                        'longitude'    => $longitude,
                                        'scopeperformed' => $data,
                                        ));
                    exit;
                }
                else
                {
                    echo json_encode(array('status'  => '1',
                                        'profileimage' => $profileimage,
                                        'name'         => $name,
                                        'company'      => $company,
                                        'email'        => $email,
                                        'phone'        => $phone,
                                        ));
                    exit;
                }

            }
            else
            {
                 echo json_encode(array('status' => '0','message' => "Private key is not correct"));
                exit;
            }

        }
        else
        {

            echo json_encode(array('status' => '0','message' => "User Id and private key is Mandatory"));
                exit;
        }
    }
    /*Name : Myprofile
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateProfile?userid=153&privatekey=1SQTsAHCnM5UWB87&company=magneto&scopeperformed=1,2,3
    Date : 01-09-18
    By   : Suvarna*/
    public function updateprofile(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "User Id and private key is Mandatory"));
                exit;
        }
        if(isset($user) && isset($key))
        {
            if(isset($request['email']))
            {
                $email = $request['email'];
                $userid = $request['userid'];
                $model  = User::where('users_id', '=',$userid)
                ->update(['users_email' => $email]);
            }
            if(isset($request['name']))
            {
                $name  = $request['name'];
                $model = User::where('users_id', '=',$userid)
                ->update(['users_name' => $name]);
            }
            if(isset($request['company']))
            {
                $company = $request['company'];
                $model   = User::where('users_id', '=',$userid)
                ->update(['users_company' => $company]);
            }
            if(isset($request['phone']))
            {
                $phone = $request['phone'];
                $model = User::where('users_id', '=',$userid)
                ->update(['users_phone' => $phone]);
            }
            if(isset($request['latitude']) && isset($request['longitude']))
            {
                $latitude = $request['latitude'];
                $longitude = $request['longitude'];
                $date = date('Y-m-d H:i:s');
                $model = User::where('users_id','=',$userid)
                ->update(['latitude' => $latitude,'longitude' => $longitude,'lat_long_updated_at' => $date]);
            }
            if(isset($request['address']))
            {
                $address = $request['address'];
                $model = User::where('users_id', '=',$userid)
                ->update(['users_address' => $address]);
            }
            $file = $request->file('image');
            if(isset($file))
            {
                $destinationPath = public_path('img/users');
                $model = User::where('users_id', '=',$userid)->first();
                $image = $model->users_profile_image;
              
                if(file_exists(public_path('img/users/'.$image)))
                {
                     unlink(public_path('img/users/'.$image));
                }
                $file = $request->file('image');
                $image_name = time() . "-" . $file->getClientOriginalName();
                $path = $file->move($destinationPath, $image_name);
                //$path = "img/users/" . $image_name;
                $profileimage = $image_name;
                $model = User::where('users_id', '=',$userid)
                ->update(['users_profile_image' => $profileimage]);
            }
            if(isset($request['scopeperformed']))
            {
                $scopeperformed = $request['scopeperformed'];
                $user = User::where('users_id','=',$userid)->first();
                $userid = $user->users_id;
                $model = UserScopePerformed::where('users_id', '=',$userid)
                ->update(['scope_performed_id' => $scopeperformed]);

            }
            echo json_encode(array('status' => '1','message' => "Profile updated successfully"));
                exit;
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "Private key or user id is incorrect"));
                exit;
        }
    }
    /*Name : Get Settings
    Url  :http://103.51.153.235/project_management/public/index.php/api/getSettings?userid=153&privatekey=1SQTsAHCnM5UWB87
    Date : 01-09-18
    By   : Suvarna*/
    public function getsettings(Request $request)
    {
        if(isset($request['userid']) && $request['privatekey'])
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
             $user = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $model = User::where('users_id', '=',$userid)->first();
                $availabilityflag = (string)$model->users_status;
                $notificationflag = (string)$model->notification_enable;
                echo json_encode(array('status' => '1','availabilityflag' => $availabilityflag,'notificationflag' => $notificationflag));
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "Private key or user id is incorrect",));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "User Id  and private key is Mandatory"));
                exit;
        }
    }
    /*Name : Update Settings
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateSettings?userid=153&privatekey=1SQTsAHCnM5UWB87
    Date : 01-09-18
    By   : Suvarna*/
    public function updateSettings(Request $request)
    {
        if(isset($request['notification']) && isset($request['availability']) && isset($request['userid']) && $request['privatekey'])
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $notificationflag = (int)$request['notification'];
            $availabilityflag = (int)$request['availability'];
            $user = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $model = User::where('users_id', '=',$userid)
                ->update(['users_status' => $availabilityflag]);
                $model = User::where('users_id', '=',$userid)
                ->update(['notification_enable' => $notificationflag]);
                echo json_encode(array('status' => '1','message' => "Update Settings successfully"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0','message' => "Private key or user id is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0','message' => "User Id  and private key is Mandatory"));
                exit;
        }
    }
    /*Name : Forgot password
    Url  :http://103.51.153.235/project_management/public/index.php/api/forgotPassword?userid=153&privatekey=krzzpdel813p0Dip&email=swatibhor.magneto@gmail.com
    Date : 01-09-18
    By   : Suvarna*/
    public function forgotpassword(Request $request)
    {
        if (isset($request['email'])) 
        {
            $email = $request['email'];
            $user  = User::where('users_email', '=',$email)->first();
            if(isset($user))
            {
                $model = new UserForgetPasswordRequest;
                $model->users_id = $user->users_id;
                $model->request_date = date('Y-m-d H:i:s');
                $model->save();
                $username = $user->users_name;
                $useremail = $user->users_email;
                $userid = base64_encode($user->users_id);
                //$user_id_d = base64_decode($user_id);
                $url = url('/forgotPassword/'.$userid);
                Mail::to($useremail)->send(new ForgotPassword($user,$url));
                echo json_encode(array('status' => '1','message' => "password reset link send on your email..please check your email"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "Your email address is incorrect"));
                exit;
            }
           
           
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Email Id is required"));
            exit;
        }
    }
    /*Name : Create Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/createProject?userid=153&privatekey=krzzpdel813p0Dip
    Date : 02-09-18
    By   : Suvarna*/
    public function createProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                if(isset($request['projectname']) && isset($request['siteaddress']) && isset($request['reportduedate']) && isset($request['scopeperformed']) && isset($request['approxbid']))
                {
                    $model = new Project;
                    $model->user_id = $userid;
                    $model->project_name = $request['projectname'];
                    $model->project_site_address = $request['siteaddress'];
                    $model->report_due_date = new DateTime($request['reportduedate']);
                    $model->latitude = $request['latitude'];
                    $model->longitude = $request['longitude'];
                    $model->milesrange = $request['miles'];
                    if(isset($request['instructions']))
                    {
                        $model->instructions = $request['instructions'];
                    }
                    if(isset($request['template']))
                    {
                        $model->report_template = $request['template'];
                    }
                    if(isset($request['scopeperformed']))
                    {
                        $model->scope_performed_id = $request['scopeperformed'];
                    }
                    $model->approx_bid = (double)$request['approxbid'];
                    $model->save();
                    $project = Project::where('user_id','=',$userid)
                    ->where('project_name','=',$request['projectname'])->get();
                    foreach ($project as $value) 
                    {
                        $projectid = $value->project_id;
                    }
                    $model = new ProjectStatus;
                    $model->project_id = $projectid;
                    $model->project_status_type_id  = 1;
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->save();
                    $latitude = (double)$request['latitude'];
                    $longitude = (double)$request['longitude'];
                    $miles = (int)$request['miles'];
                    $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                        FROM users
                        WHERE  user_types_id <>1
                        HAVING distance <= $miles"));
                    foreach ($result as $value) 
                    {
                       $model = new ProjectNotification;
                       $model->to_user_id = $value->users_id;
                       $model->from_user_id = $userid;
                       $model->project_id = $projectid;
                       $model->project_notification_type_id = 1;
                       $model->created_at = date('Y-m-d H:i:s');
                       $model->save();
                      /* $model = new ProjectBidRequest;
                       $model->project_id = $projectid;
                       $model->to_user_id = $value->users_id;
                       $model->from_user_id = $userid;
                       $model->created_at = date('Y-m-d H:i:s');
                       $model->save();
*/
                    }
                    echo json_encode(array('status' => '1', 'message' => "Project created successfully"));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
                    exit;
                }
           }
           else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }

    }
     /*Name : user profile 
    Url  :http://103.51.153.235/project_management/public/index.php/api/userProfile?userid=170&privatekey=mVrhsbUfylAFTtqI
    Date : 03-09-18
    By   : Suvarna*/
    public function userprofile(Request $request)
    {
        if(isset($request['privatekey']) && isset($request['userid']))
        {
            $privatekey = $request['privatekey'];
            $userid     = $request['userid'];
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $username = $user->users_name;
                $usertype = $user->user_types_id;
                $profileimage = asset("/img/users/" . $user['users_profile_image']);
                if($usertype == 1)
                {
                    $bidmade = ProjectBid::where('project_bid_status','=',1)->get();
                    $bidmadecount = 0;
                    foreach ($bidmade as  $value) 
                    {
                        $projectbidid = $value->project_id;
                        $model = Project::where('user_id','=',$userid)
                        ->where('project_id','=',$projectbidid)->get();
                        if(count($model)>0)
                        {
                            $bidmadecount = $bidmadecount + 1;  
                        }
                    }
                    $completedproject = Project::where('user_id','=',$userid)->get();
                    $completedprojectcount = 0;
                    foreach ($completedproject as $value) 
                    {
                        $projectid = $value->project_id;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',4)->get();
                        if(count($model)>0)
                        {
                            $completedprojectcount = $completedprojectcount + 1;
                        }
                    }
                    $overdueprojectcount = 0;
                    $project = Project::where('user_id','=',$userid)->get();
                    foreach ($project as $value) 
                    {
                        $projectid = $value->project_id;
                        $reportduedate = $value->report_due_date;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',3)->
                        orWhere('project_status_type_id','=',2)->
                        where('created_at','>',$reportduedate)->get();
                        if(count($model) > 0)
                        {
                            $overdueprojectcount = $overdueprojectcount + 1;
                        }

                    }
                }
                else
                {
                    $projectcount = ProjectBid::where('user_id','=',$userid)
                    ->where('project_bid_status','=',1)->count();
                    
                    $bidmadecount = ProjectBid::where('project_bid_status','=',1)
                    ->where('user_id','=',$userid)->count();
                    $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->get();
                    $completedprojectcount = 0;
                    foreach ($completedproject as $value) 
                    {
                        $projectid = $value->project_id;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',4)->get();
                        if(count($model) > 0)
                        {
                            $completedprojectcount = $completedprojectcount + 1;
                        }
                    }
                    $overdueprojectcount = 0;
                    $projectbid = ProjectBid::where('user_id','=',$userid)->
                                   where('project_bid_status','=',1)->get();

                    if(count($projectbid) > 0)
                    {
                        foreach ($projectbid as $value) 
                        {
                            $projectid = $value->project_id;
                            $project = Project::where('project_id','=',$projectid)->
                            first();
                            $reportduedate = $project->report_due_date;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=', 3)->
                            orWhere('project_status_type_id','=', 2)->
                            where('created_at','>', $reportduedate)->get();
                            if(count($model) > 0)
                            {
                                $overdueprojectcount = $overdueprojectcount + 1;
                            }

                        }
                    }
                       
                }
                $review = UserReview::where('to_user_id','=',$userid)->
                where('user_review_status','=',1)->max('user_review_ratings');
                echo json_encode(array('status'  => '1',
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' =>(string)$overdueprojectcount,
                                        'review' => (string)$review));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : user Review 
    Url  :http://103.51.153.235/project_management/public/index.php/api/userReview?userid=170&privatekey=agi7heyEv2xtcYYb
    Date : 04-09-18
    By   : Suvarna*/
    public function userReview(Request $request)
    {
        if(isset($request['privatekey']) && isset($request['userid']))
        {
            $privatekey = $request['privatekey'];
            $userid     = $request['userid'];
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $review = UserReview::where('to_user_id','=',$userid)
                ->where('user_review_status','=',1)->get();
                if(count($review)>0)
                {
                    foreach ($review as $value)
                    {
                        $byuserid = $value['from_user_id'];
                        $model = User::where('users_id','=',$byuserid)->first();
                        $username = $model->users_name;
                        $profileimage = asset("/img/users/" . $model['users_profile_image']);
                        $commentdate = $value['created_at']->format("jS F Y h:i A");
                        $userreview[] = ['profileimage' => $profileimage, 'username' =>  $username, 'rating' => (string)$value['user_review_ratings'],
                        'comment' => $value['user_review_comments'],
                        'commentdate' => $commentdate];
                    }
                    echo json_encode(array('status' => '1', 
                                            'userreview' => $userreview));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "no any review for this user"));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }

    }
    /*Name : user Logout
    Url  :http://103.51.153.235/project_management/public/index.php/api/        userLogout?userid=182&privatekey=WLhJOYbfdjdN9s9R&deviceid=498
    Date : 04-09-18
    By   : Suvarna*/
    public function logout(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $devicetype = $request['devicetype'];
                $userdeviceid = $request['deviceid'];
                $model = UserAccessKey::where('user_access_key', '=',$accesskey)
                        ->where('user_id', '=',$userid)
                        ->where('user_device_id', '=',$userdeviceid)
                        ->update(['logout_status' => 1]);
                $model = UserAccessKey::where('user_access_key', '=',$accesskey)
                        ->where('user_id', '=',$userid)
                        ->where('user_device_id', '=',$userdeviceid)
                        ->update(['user_access_key_status' => 0]);
                $date = date('Y-m-d H:i:s');
                $model = UserAccessKey::where('user_access_key', '=',$accesskey)
                        ->where('user_id', '=',$userid)
                        ->where('user_device_id', '=',$userdeviceid)
                        ->update(['logout_datetime' => $date]);
                echo json_encode(array('status' => '1','message' => "Logout successfully"));
                exit;

            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
     /*Name : publish project
    Url  :http://103.51.153.235/project_management/public/index.php/api/publishProject?userid=170&privatekey=agi7heyEv2xtcYYb
    Date : 04-09-18
    By   : Suvarna*/
    public function publishProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $project = Project::where('user_id','=',$userid)->get();
                if(isset($project))
                {
                    foreach($project as $value)
                    {
                        $projectid = $value->project_id;
                        $status = ProjectStatus::where('project_id','=',$projectid)->get();
                        foreach($status as $value) 
                        {
                            $statusvalue = $value->project_status_type_id;
                        }
                        if($statusvalue == 1)
                        {
                            $publishproject = Project::where('project_id','=',$value->project_id)->first();
                            $scope = $publishproject->scope_performed_id;
                            $data = [];
                            $temp = explode(",", $scope);
                            foreach($temp as $value) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$value)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $reportduedate = $publishproject['report_due_date'];
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $created_at = (String)$publishproject->created_at;
                            $datetime2 = new DateTime($created_at);
                            $created_at= $datetime2->format("Y-m-d");
                            $projectbidcount = ProjectBid::where('project_id','=',$projectid)->count();
                            $publishprojects[] = ['projectid' => (string)$publishproject->project_id, 
                                'projectname' =>  $publishproject->project_name, 
                                'siteaddress' => $publishproject->project_site_address,
                                'createddate'  => $created_at,
                                'reportduedate' => $reportduedate,
                                'template' => $publishproject->report_template,
                                'instructions' => $publishproject->instructions,
                                'approxbid' =>(String)$publishproject->approx_bid,
                                'projectbidcount' =>(string)$projectbidcount,
                                'scopeperformed' => $data,
                                ];
                        }
                        
                    }
                    echo json_encode(array('status' => '1','publishprojects' => $publishprojects));
                    exit;
                }
                echo json_encode(array('status' => '0', 'message' => "No any project for publish"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Project Detail 
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectDetail?userid=182&privatekey=SsngS44DXdSCz2WK&projectid=14
    Date : 14-09-18
    By   : Suvarna*/
    public function projectDetail(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                $project = Project::where('project_id','=',$projectid)->first();
                $scope = $project->scope_performed_id;
                $data = [];
                $temp = explode(",", $scope);
                foreach($temp as $value) 
                {
                    $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                            ->where('scope_performed_id','=',(int)$value)->first();
                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                'scope_performed' => $scopeperformed->scope_performed];
                }
                $reportduedate = (string)$project->report_due_date;
                $datetime2 = new DateTime($reportduedate);
                $reportduedate= $datetime2->format("Y-m-d");
                $createddate = (string)$project->created_at;
                $datetime2 = new DateTime($createddate);
                $createddate = $datetime2->format("Y-m-d");
                if($user->user_types_id != 1)
                {
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                                ->where('user_id','=',$userid)->get();
                    if($projectbid->count() > 0)
                    {
                    foreach ($projectbid as $value) 
                    {
                        $previousbid = $value->associate_suggested_bid;
                    }
                    $previousbid = (string)$previousbid;
                    }
                    else
                    {
                        $previousbid = 0;
                    }
                    echo json_encode(array('status' => '1',
                                'projectid' => (string)$project->project_id, 
                                'projectname' =>  $project->project_name, 
                                'siteaddress' => $project->project_site_address,
                                'latitude' => $project->latitude,
                                'longitude' => $project->longitude,
                                'milesrange' => (string)$project->milesrange,
                                'createddate' => $createddate,
                                'reportduedate' => $reportduedate,
                                'template' => (string)$project->report_template,
                                'instructions' => $project->instructions,
                                'approxbid' =>(String)$project->approx_bid,
                                'previousbid' => (string)$previousbid,
                                'scopeperformed' => $data));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '1',
                                'projectid' => (string)$project->project_id, 
                                'projectname' =>  $project->project_name, 
                                'siteaddress' => $project->project_site_address,
                                'latitude'  => $project->latitude,
                                'longitude' => $project->longitude,
                                'milesrange' => (string)$project->milesrange,
                                'createddate' => $createddate,
                                'reportduedate' => $reportduedate,
                                'template' => (string)$project->report_template,
                                'instructions' => $project->instructions,
                                'approxbid' =>(String)$project->approx_bid,
                                'scopeperformed' => $data));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Complete Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/completeProject?userid=182&privatekey=SsngS44DXdSCz2WK
    Date : 05-09-18
    By   : Suvarna*/
    public function completeProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $usertype = $user->user_types_id;
                if($usertype == 1)
                {
                $project = Project::where('user_id','=',$userid)->get();
                if(isset($project))
                {
                    foreach($project as $value)
                    {
                        $projectid = $value->project_id;
                        $status = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',4)->first();
                        if(isset($status))
                        {
                            $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                            
                            $scope = $projectdetail->scope_performed_id;
                            $data = [];
                            $temp = explode(",", $scope);
                            foreach($temp as $value) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$value)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $projectbid = ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=',1)->first();
                            $finalbid = $projectbid->associate_suggested_bid;
                            $userreview = UserReview::where('project_id','=',$projectid)
                                        ->where('from_user_id','=',$projectbid->user_id)
                                        ->first();
                            if(isset($userreview))
                            {
                                $rating = (string)$userreview->user_review_ratings;
                                $comment = $userreview->user_review_comments;
                            }
                            else
                            {
                                $rating = 'null';
                                $comment = 'null';
                            }
                            $createddate = (string)$projectdetail->created_at;
                            $datetime2 = new DateTime($createddate);
                            $createddate= $datetime2->format("Y-m-d");
                            $reportduedate = (string)$projectdetail->report_due_date;
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'createddate' =>(string)$createddate,
                                'reportduedate' => (string)$reportduedate,
                                'scopeperformed' => $data,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'finalbid'    =>(string)$finalbid,
                                'rating'   => $rating,
                                'comment'  => $comment
                                ];
                        }
                        
                    }
                   if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project completed"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project completed"));
                    exit;
                }
            }
            else
            {
                $projectbid = ProjectBid::where('user_id','=',$userid)
                            ->where('project_bid_status','=',1)->get();
                if(isset($projectbid))
                {
                    foreach ($projectbid as  $value) 
                    {
                        $projectid = $value->project_id;
                        $project = Project::where('project_id','=',$projectid)->first();
                        $status = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',4)->first();
                        if(isset($status))
                        {
                            $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                            $scope = $projectdetail->scope_performed_id;
                            $data = [];
                            $temp = explode(",", $scope);
                            foreach($temp as $scope) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $finalbid = (string)$value->associate_suggested_bid;
                            $userreview = UserReview::where('project_id','=',$projectid)
                                        ->where('from_user_id','=',$projectdetail->user_id)
                                        ->first();
                            if(isset($userreview))
                            {
                                $rating = (string)$userreview->user_review_ratings;
                                $comment = $userreview->user_review_comments;
                            }
                            else
                            {
                                $rating = 'null';
                                $comment = 'null';
                            }
                            $createddate = (string)$projectdetail->created_at;
                            $datetime2 = new DateTime($createddate);
                            $createddate= $datetime2->format("Y-m-d");
                            $reportduedate = (string)$projectdetail->report_due_date;
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'createddate' => $createddate,
                                'scopeperformed' => $data,
                                'reportduedate' => $reportduedate,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'finalbid' => $finalbid,
                                'rating'   => $rating,
                                'comment'  => $comment
                                ];
                        }
                        
                    }
                    if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project completed"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project completed"));
                    exit;
                }
                
            }

               
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Cancel Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/cancelProject?userid=182&privatekey=SsngS44DXdSCz2WK
    Date : 05-09-18
    By   : Suvarna*/
    public function cancelProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $usertype = $user->user_types_id;
                if($usertype == 1)
                {
                $project = Project::where('user_id','=',$userid)->get();
                if(isset($project))
                {
                    foreach($project as $value)
                    {
                        $projectid = $value->project_id;
                        $status = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',5)->first();
                        if(isset($status))
                        {
                            $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                            $scope = $projectdetail->scope_performed_id;
                            $data = [];
                            $temp = explode(",", $scope);
                            foreach($temp as $scope) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $projectbid = ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=',1)->first();
                            $finalbid = (string)$projectbid->associate_suggested_bid;
                            $createddate = (string)$projectdetail->created_at;
                            $datetime2 = new DateTime($createddate);
                            $createddate= $datetime2->format("Y-m-d");
                            $reportduedate = (string)$projectdetail->report_due_date;
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'createddate' => $createddate,
                                'reportduedate' => $reportduedate,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                            'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'finalbid' => $finalbid,
                                'scopeperformed' => $data,
                                'rating'   => 'null',
                                'comment'  => 'null'
                                ];
                        }
                        
                    }
                    if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project cancelled"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project cancelled"));
                    exit;
                }
            }
            else
            {
                $projectbid = ProjectBid::where('user_id','=',$userid)
                            ->where('project_bid_status','=',1)->get();
                if(isset($projectbid))
                {
                    foreach ($projectbid as  $value) 
                    {
                        $projectid = $value->project_id;
                        $project = Project::where('project_id','=',$projectid)->first();
                        $status = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',5)->first();
                        if(isset($status))
                        {
                            $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                            $scope = $projectdetail->scope_performed_id;
                            $data = [];
                            $temp = explode(",", $scope);
                            foreach($temp as $scope) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $finalbid = (string)$value->associate_suggested_bid;
                            $createddate = (string)$projectdetail->created_at;
                            $datetime2 = new DateTime($createddate);
                            $createddate= $datetime2->format("Y-m-d");
                            $reportduedate = (string)$projectdetail->report_due_date;
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'createddate' => $createddate,
                                'reportduedate' => $reportduedate,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'finalbid' => $finalbid,
                                'scopeperformed' => $data,
                                'rating'   => 'null',
                                'comment'  => 'null'
                                ];
                        }
                        
                    }
                    if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project cancelled"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project cancelled"));
                    exit;
                }
                
            }

               
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : In progess projects
    Url  :http://103.51.153.235/project_management/public/index.php/api/inProgessProject?
    userid=182&privatekey=1SQTsAHCnM5UWB87
    Date : 14-09-18
    By   : Suvarna*/
    public function inProgessProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $usertype = $user->user_types_id;
                if($usertype == 1)
                {
                $project = Project::where('user_id','=',$userid)->get();
                if(isset($project))
                {
                    foreach($project as $value)
                    {
                        $projectid = $value->project_id;
                        $status = ProjectStatus::where('project_id','=',$projectid)->get();
                        if(isset($status))
                        {
                            foreach ($status as $projectstatus) 
                            {
                                $statusvalue = $projectstatus->project_status_type_id;
                            }
                            if($statusvalue == 3)
                            {
                                $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                                $scope = $projectdetail->scope_performed_id;
                                $data = [];
                                $temp = explode(",", $scope);
                                foreach($temp as $scope) 
                                {
                                    $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                    ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                                }
                                $reportduedate = $projectdetail['report_due_date'];
                                $datetime2 = new DateTime($reportduedate);
                                $reportduedate= $datetime2->format("Y-m-d");
                                $created_at = (String)$projectdetail->created_at;
                                $datetime2 = new DateTime($created_at);
                                $created_at= $datetime2->format("Y-m-d");
                                $projectbid = ProjectBid::where('project_id','=',$projectdetail->project_id)->where('project_bid_status','=',1)->first();
                                $associatebid = $projectbid->associate_suggested_bid;
                                $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'createddate' => $created_at,
                                'reportduedate' => $reportduedate,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'associatebid' => (string)$associatebid,
                                'scopeperformed' => $data,
                                ];
                            }
                        }
                        
                    }
                   if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project in progress"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project in progress"));
                    exit;
                }
            }
            else
            {
                $projectbid = ProjectBid::where('user_id','=',$userid)
                            ->where('project_bid_status','=',1)->get();
                if(isset($projectbid))
                {
                    foreach ($projectbid as  $value) 
                    {
                        $projectid = $value->project_id;
                        $project = Project::where('project_id','=',$projectid)->first();
                        $status = ProjectStatus::where('project_id','=',$projectid)
                                  ->get();
                        if(isset($status))
                        {
                            foreach ($status as $projectstatus) 
                            {
                                $statusvalue = $projectstatus->project_status_type_id;
                            }
                            if($statusvalue == 3)
                            {
                                $projectdetail = Project::where('project_id','=',$value->project_id)->first();
                                $scope = $projectdetail->scope_performed_id;
                                $data = [];
                                $temp = explode(",", $scope);
                                foreach($temp as $scope) 
                                {
                                    $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                    ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                                }
                                $reportduedate = $projectdetail['report_due_date'];
                                $datetime2 = new DateTime($reportduedate);
                                $reportduedate= $datetime2->format("Y-m-d");
                                $created_at = (String)$projectdetail->created_at;
                                $datetime2 = new DateTime($created_at);
                                $created_at= $datetime2->format("Y-m-d");
                                $projectbid = ProjectBid::where('project_id','=',$projectdetail->project_id)->where('project_bid_status','=',1)->first();
                                $associatebid = $projectbid->associate_suggested_bid;
                                $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'reportduedate' => $reportduedate,
                                'createddate' => $created_at,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'suggestedbid' =>(String)$projectdetail->approx_bid,
                                'associatebid' =>(string)$associatebid,
                                'scopeperformed' => $data,
                                ];
                            }
                        }
                        
                    }
                    if(isset($projectdetails))
                    {
                        echo json_encode(array('status' => '1','publishprojects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "No any project in progress"));
                        exit;
                    }
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any project in progress"));
                    exit;
                }
                
            }

               
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : view user profile for project history 
    Url  :http://103.51.153.235/project_management/public/index.php/api/viewProfile?userid=182&privatekey=10l4SesaKyxue87i&projectid=1
    Date : 07-09-18
    By   : Suvarna*/
    public function viewProfile(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user  = User::where('users_id', '=',$userid)->first();
            $key   = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            if(isset($user) && isset($key))
            {
                $usertypeid = $user->user_types_id;
                if($usertypeid == 1)
                {
                    $projectid = $request['projectid'];
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=',1)->first();
                    $associateid = $projectbid->user_id;
                    $associate = User::where('users_id','=',$associateid)->first();
                    $username = $associate->users_name;
                    $usertype = $associate->user_types_id;
                    $company =$associate->users_company;
                    $phone = $associate->users_phone;
                    $email = $associate->users_email;
                    $profileimage = asset("/img/users/" . $associate['users_profile_image']);
                    $projectcount = ProjectBid::where('user_id','=',$associateid)
                    ->where('project_bid_status','=',1)->count();
                    
                    $bidmadecount = ProjectBid::where('project_bid_status','=',1)
                    ->where('user_id','=',$associateid)->count();
                    $completedproject = ProjectBid::where('user_id','=',$associateid)->
                                            where('project_bid_status','=',1)->get();
                    $completedprojectcount = 0;
                    foreach ($completedproject as $value) 
                    {
                        $projectid = $value->project_id;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',4)->get();
                        if(count($model) > 0)
                        {
                            $completedprojectcount = $completedprojectcount + 1;
                        }
                    }
                    $overdueprojectcount = 0;
                    $projectbid = ProjectBid::where('user_id','=',$associateid)->
                                   where('project_bid_status','=',1)->get();

                    if(count($projectbid) > 0)
                    {
                        foreach ($projectbid as $value) 
                        {
                            $projectid = $value->project_id;
                            $project = Project::where('project_id','=',$projectid)->
                            first();
                            $reportduedate = $project->report_due_date;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=', 3)->
                            orWhere('project_status_type_id','=', 2)->
                            where('created_at','>', $reportduedate)->get();
                            if(count($model) > 0)
                            {
                                $overdueprojectcount = $overdueprojectcount + 1;
                            }

                        }
                    }

                    $review = UserReview::where('to_user_id','=',$associateid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
                    echo json_encode(array('status'  => '1',
                                        'userid'  => (string)$associateid,
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'usertype' =>(string)$usertype,
                                        'company' => $company,
                                        'phone' => $phone,
                                        'email' => $email,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' =>(string)$overdueprojectcount,
                                        'review' => (string)$review));
                    exit;
                }
            else
            {
                $projectid = $request['projectid'];
                $scheduler = Project::where('project_id','=',$projectid)->first();
                $schedulerid = $scheduler->user_id;
                $scheduler = User::where('users_id','=',$schedulerid)->first();
                $username = $scheduler->users_name;
                $usertype = $scheduler->user_types_id;
                $company = $scheduler->users_company;
                $phone = $scheduler->users_phone;
                $email = $scheduler->users_email;
                $profileimage = asset("/img/users/" . $scheduler['users_profile_image']);
                $bidmade = ProjectBid::where('project_bid_status','=',1)->get();
                $bidmadecount = 0;
                    foreach ($bidmade as  $value) 
                    {
                        $projectbidid = $value->project_id;
                        $model = Project::where('user_id','=',$schedulerid)
                        ->where('project_id','=',$projectbidid)->get();
                        if(count($model)>0)
                        {
                            $bidmadecount = $bidmadecount + 1;  
                        }
                    }
                    $completedproject = Project::where('user_id','=',$schedulerid)->get();
                    $completedprojectcount = 0;
                    foreach ($completedproject as $value) 
                    {
                        $projectid = $value->project_id;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',4)->get();
                        if(count($model)>0)
                        {
                            $completedprojectcount = $completedprojectcount + 1;
                        }
                    }
                    $overdueprojectcount = 0;
                    $project = Project::where('user_id','=',$schedulerid)->get();
                    foreach ($project as $value) 
                    {
                        $projectid = $value->project_id;
                        $reportduedate = $value->report_due_date;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',3)->
                        orWhere('project_status_type_id','=',2)->
                        where('created_at','>',$reportduedate)->get();
                        if(count($model) > 0)
                        {
                            $overdueprojectcount = $overdueprojectcount + 1;
                        }

                    }
            }
            $review = UserReview::where('to_user_id','=',$schedulerid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
                    echo json_encode(array('status'  => '1',
                                        'userid'  => (string)$schedulerid,
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'usertype' => (string)$usertype,
                                        'company' => $company,
                                        'phone' => (string)$phone,
                                        'email' => $email,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' => (string)$overdueprojectcount,
                                        'review' => (string)$review));
                    exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : view user review
    Url  :http://103.51.153.235/project_management/public/index.php/api/viewUserReview?userid=182&privatekey=10l4SesaKyxue87i&reviewuserid=181
    Date : 07-09-18
    By   : Suvarna*/
    public function viewUserReview(Request $request)
    {
        if(isset($request['privatekey']) && isset($request['userid']))
        {
            $privatekey = $request['privatekey'];
            $userid     = $request['userid'];
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $reviewuserid = $request['reviewuserid'];
                $review = UserReview::where('to_user_id','=',$reviewuserid)
                ->where('user_review_status','=',1)->get();
                if(count($review)>0)
                {
                    foreach ($review as $value)
                    {
                        $byuserid = $value['from_user_id'];
                        $model = User::where('users_id','=',$byuserid)->first();
                        $username = $model->users_name;
                        $profileimage = asset("/img/users/" . $model['users_profile_image']);
                        $commentdate = $value['created_at']->format("jS F Y h:i A");
                        $userreview[] = ['profileimage' => $profileimage, 'username' =>  $username, 'rating' => (string)$value['user_review_ratings'],
                        'comment' => $value['user_review_comments'],
                        'commentdate' => $commentdate];
                    }
                    echo json_encode(array('status' => '1', 
                                            'userreview' => $userreview));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "no any review for this user"));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }

    }
    /*Name : Update Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateProject?userid=182&privatekey=10l4SesaKyxue87i&projectid=5&template=Quire1
    Date : 07-09-18
    By   : Suvarna*/
    public function updateProject(Request $request)
    {
        if(isset($request['privatekey']) && isset($request['userid']))
        {
            $privatekey = $request['privatekey'];
            $userid     = $request['userid'];
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                if(isset($request['projectname']))
                {
                    $projectname = $request['projectname'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['project_name' => $projectname]);
                }
                if(isset($request['siteaddress']))
                {
                    $siteaddress = $request['siteaddress'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['project_site_address' => $siteaddress]);
                }
                if(isset($request['latitude']) && isset($request['longitude']))
                {
                    $latitude = $request['latitude'];
                    $longitude = $request['longitude'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['latitude' => $latitude, 'longitude' => $longitude]);
                }
                if(isset($request['miles']))
                {
                    $miles = (int)$request['miles'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['milesrange' => $miles]);
                }
                if(isset($request['reportduedate']))
                {
                    $reportduedate = new DateTime($request['reportduedate']);
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['report_due_date' => $reportduedate]);
                }
                if(isset($request['template']))
                {
                    $template = $request['template'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['report_template' => $template]);
                }
                if(isset($request['scopeperformed']))
                {
                    $scopeperformed = $request['scopeperformed'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['scope_performed_id' => $scopeperformed]);
                }
                if(isset($request['instructions']))
                {
                    $instructions = $request['instructions'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['instructions' => $instructions]);
                }
                if(isset($request['approxbid']))
                {
                    $approxbid = (double)$request['approxbid'];
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['approx_bid' => $approxbid]);
                }
                echo json_encode(array('status' => '1', 'message' => "Project updated successfully"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Project Inprogress Status
    Url  :http://103.51.153.235/project_management/public/index.php/api/inprogressStatus?userid=182&privatekey=10l4SesaKyxue87i&projectid=1
    Date : 14-09-18
    By   : Suvarna*/
    public function inprogressStatus(Request $request)
    {
        if(isset($request['privatekey']) && isset($request['userid']))
        {
            $privatekey = $request['privatekey'];
            $userid     = $request['userid'];
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
            ->where('user_access_key_status','=',1)
            ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                $progress = ProjectProgressStatus::where('project_id','=',$projectid)
                                ->get();
                if(count($progress) > 0)
                {
                    foreach ($progress as $value) 
                    {
                        $subject = $value->project_progress_status_subject;
                        $status = $value->project_progress_status;
                        $createddate = $value->created_at->format("jS F Y h:i A");
                        $progressstatus[] = ['subject' => $subject, 'status' =>  $status, 'createddate' => (string)$createddate];
                    }
                    echo json_encode(array('status' => '1', 'progressstatus' =>$progressstatus));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any status for this Project"));
                    exit;
                }

            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Store User reviews
    Url  :http://103.51.153.235/project_management/public/index.php/api/storeuserReview?userid=182&privatekey=10l4SesaKyxue87i&projectid=1&ratings=4.5&comment=good
    Date : 14-09-18
    By   : Suvarna*/
    public function storeuserReview(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {

            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                if($user->user_types_id == 1)
                {
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                        ->where('project_bid_status','=',1)->first();
                    $touserid = $projectbid->user_id;
                }
                else
                {
                    $project = Project::where('project_id','=',$projectid)->first();
                    $touserid = $project->user_id;
                }
                if(isset($request['ratings']))
                {

                    $review = new UserReview;
                    $review->from_user_id = (int)$userid;
                    $review->to_user_id = $touserid;
                    $review->project_id = (int)$request['projectid'];
                    $review->user_review_ratings = (double)$request['ratings'];
                    if(isset($request['comment']))
                    {
                        $review->user_review_comments = $request['comment'];
                    }
                    $review->save();
                    echo json_encode(array('status' => '1','message' => "User review store successfully"));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : get Miles range value
    Url  :http://103.51.153.235/project_management/public/index.php/api/getMilesValue?userid=182&privatekey=10l4SesaKyxue87i
    Date : 14-09-18
    By   : Suvarna*/
     public function getMilesValue(Request $request)
    {
        $setting = Setting::where('setting_status','=',1)->first();
        if(isset($setting))
        {
            $minvalue = (string)$setting->min_miles;
            $maxvalue = (string)$setting->max_miles;
            echo json_encode(array('status' => '1', 'minmiles' => $minvalue, 'maxmiles' => $maxvalue));
                exit;
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "No setting value"));
                exit;
        }
    }
    /*Name : view project bids
    Url  :http://103.51.153.235/project_management/public/index.php/api/viewBids?userid=182&privatekey=10l4SesaKyxue87i&projectid=1
    Date : 14-09-18
    By   : Suvarna*/
    public function viewBids(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                $bid = ProjectBid::where('project_id','=',$projectid)
                ->get();
                if(count($bid) > 0 )
                {
                    foreach ($bid as $value) 
                    {
                        $projectid = $value->project_id;
                        $projects = Project::where('project_id','=',$projectid)->first();
                        $projectname = $projects->project_name;
                        $suggestedbid = $projects->approx_bid;
                        $associateid = $value->user_id;
                        $associate = User::where('users_id','=',$associateid)->first();
                        $projectbids[] = ['associatename' => $associate->users_name, 
                            'associatebid' =>  (string)$value->associate_suggested_bid,
                            'associateid' => (string)$associateid,
                            'projectname' => $projectname,
                            'suggestedbid' => (string)$suggestedbid];
                    }
                    echo json_encode(array('status' => '1', 'projectbids' => $projectbids));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "No any bids for this project"));
                    exit;
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;   
        }
    }
    /*Name : Add project status
    Url  :http://103.51.153.235/project_management/public/index.php/api/addStatus?userid=181&privatekey=WOIBYa5i66feh8N1&projectid=17&subject=level4&status=xyz
    Date : 14-09-18
    By   : Suvarna*/
    public function addStatus(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                if(isset($request['subject']))
                {
                    $statussubject = $request['subject'];
                }
                if(isset($request['status']))
                {
                    $status = $request['status'];
                }
                $inprogress = new ProjectProgressStatus;
                $inprogress->user_id = $userid;
                $inprogress->project_id = $request['projectid'];
                $inprogress->project_progress_status_subject = $statussubject;
                $inprogress->project_progress_status = $status;
                $inprogress->save();
                 echo json_encode(array('status' => '1', 'message' => "Status added successfully"));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : associate bids
    Url  :http://103.51.153.235/project_management/public/index.php/api/myBids?%20userid=181&privatekey=WOIBYa5i66feh8N1
    Date : 14-09-18
    By   : Suvarna*/
    public function myBids(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $associatebid = ProjectBid::where('user_id','=',$userid)->get();
                if(count($associatebid) > 0)
                {
                    foreach ($associatebid as $value) 
                    {
                        $projectid = $value->project_id;
                        $projectbid = ProjectBid::where('project_id','=',$projectid)
                        ->where('project_bid_status','=', 1)->first();
                        if(!isset($projectbid))
                        {
                           
                            $project = Project::where('project_id','=',$projectid)->first();
                            $projectname = $project->project_name;
                            $siteaddress = $project->project_site_address;
                            if($value->project_bid_status == 1)
                            {
                                $bidstatus = "Bid approved";
                            }
                            elseif($value->project_bid_status == 0)
                            {
                                $bidstatus = "Bid Rejected";
                            }
                            else
                            {
                                $bidstatus = "Awaiting response";
                            }
                            $bid = $value->associate_suggested_bid;
                            $mybids[] = ['projectid' => (string)$projectid, 'projectname' => $projectname,'siteaddress' => $siteaddress,
                            'yourbid' => (string)$bid, 'bidstatus' => $bidstatus,
                            'bidstatusflag' => (string)$value->project_bid_status];
                        }

                    }
                    if(isset($mybids))
                    {
                        echo json_encode(array('status' => '1', 'mybids' => $mybids));
                        exit;
                    }
                    else
                    {
                        echo json_encode(array('status' => '0', 'message' => "Yet no any bid made"));
                        exit; 
                    }

                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "Yet no any bid made"));
                    exit;   
                }
            
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : bid request
    Url  :http://103.51.153.235/project_management/public/index.php/api/bidRequest?userid=181&privatekey=eVpUnLCUoGRPDvT2&projectid=14&bidvalue=5000
    Date : 15-09-18
    By   : Suvarna*/
    public function bidrequest(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                if(isset($request['bidvalue']))
                {
                    $bidamount = (int)$request['bidvalue'];
                    $projectid = (int)$request['projectid'];
                    $userid = $request['userid'];
                    $bid = new ProjectBid;
                    $bid->project_id = $projectid;
                    $bid->user_id = $userid;
                    $bid->associate_suggested_bid = $bidamount;
                    $bid->created_at = date('Y-m-d H:i:s');
                    $bid->bid_status = 1;
                    $bid->save();

                    echo json_encode(array('status' => '1', 'message' => "bid request applied successfully"));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
                    exit;  
                }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : complete project by Scheduler
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectComplete?%20userid=182&privatekey=U5Z5Y9PLqrR1zm9B&projectid=24
    Date : 15-09-18
    By   : Suvarna*/
    public function projectComplete(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                $model = new ProjectStatus;
                $model->project_id = $projectid;
                $model->project_status_type_id  = 4;
                $model->created_at = date('Y-m-d H:i:s');
                $model->save();
                echo json_encode(array('status' => '1', 'message' => "Project completed successfully"));
                exit;                                         
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : cancel project by Scheduler
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectCancel?%20userid=182&privatekey=U5Z5Y9PLqrR1zm9B&projectid=24
    Date : 15-09-18
    By   : Suvarna*/
    public function projectCancel(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $projectid = $request['projectid'];
                $model = new ProjectStatus;
                $model->project_id = $projectid;
                $model->project_status_type_id  = 5;
                $model->created_at = date('Y-m-d H:i:s');
                $model->save();
                echo json_encode(array('status' => '1', 'message' => "Project cancelled successfully"));
                exit;                                         
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : associate profile for in publish project
    Url  :http://103.51.153.235/project_management/public/index.php/api/associateProfile?userid=182&privatekey=10l4SesaKyxue87i&associateid=181
    Date : 18-09-18
    By   : Suvarna*/
    public function associateProfile(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
          
            $userid = (int)$request['userid'];
            $accesskey = $request['privatekey'];
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            $user = User::where('users_id', '=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
                $associateid = $request['associateid'];
                $associate = User::where('users_id','=',$associateid)->first();
                    $username = $associate->users_name;
                    $usertype = $associate->user_types_id;
                    $company =$associate->users_company;
                    $phone = $associate->users_phone;
                    $email = $associate->users_email;
                    $profileimage = asset("/img/users/" . $associate['users_profile_image']);
                    $projectcount = ProjectBid::where('user_id','=',$associateid)
                    ->where('project_bid_status','=',1)->count();
                    
                    $bidmadecount = ProjectBid::where('project_bid_status','=',1)
                    ->where('user_id','=',$associateid)->count();
                    $completedproject = ProjectBid::where('user_id','=',$associateid)->
                                            where('project_bid_status','=',1)->get();
                    $completedprojectcount = 0;
                    foreach ($completedproject as $value) 
                    {
                        $projectid = $value->project_id;
                        $model = ProjectStatus::where('project_id','=',$projectid)->
                        where('project_status_type_id','=',4)->get();
                        if(count($model) > 0)
                        {
                            $completedprojectcount = $completedprojectcount + 1;
                        }
                    }
                    $overdueprojectcount = 0;
                    $projectbid = ProjectBid::where('user_id','=',$associateid)->
                                   where('project_bid_status','=',1)->get();

                    if(count($projectbid) > 0)
                    {
                        foreach ($projectbid as $value) 
                        {
                            $projectid = $value->project_id;
                            $project = Project::where('project_id','=',$projectid)->
                            first();
                            $reportduedate = $project->report_due_date;
                            $model = ProjectStatus::where('project_id','=',$projectid)->
                            where('project_status_type_id','=', 3)->
                            orWhere('project_status_type_id','=', 2)->
                            where('created_at','>', $reportduedate)->get();
                            if(count($model) > 0)
                            {
                                $overdueprojectcount = $overdueprojectcount + 1;
                            }

                        }
                    }

                    $review = UserReview::where('to_user_id','=',$associateid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
                    echo json_encode(array('status'  => '1',
                                        'userid'  => (string)$associateid,
                                        'username'     => $username,
                                        'profileimage' => $profileimage,
                                        'usertype' =>(string)$usertype,
                                        'bidmadecount' => (string)$bidmadecount,
                                        'completedprojectcount' => (string)$completedprojectcount,
                                        'overdueprojectcount' =>(string)$overdueprojectcount,
                                        'review' => (string)$review));
                    exit;
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    /*Name : Available Projects for associate
    Url  :http://103.51.153.235/project_management/public/index.php/api/availableProject?%20userid=181&privatekey=U5Z5Y9PLqrR1zm9B
    Date : 18-09-18
    By   : Suvarna*/
    public function availableProject(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']))
        {
            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $user = User::where('users_id','=',$userid)->first();
            $key = UserAccessKey::where('user_access_key','=',$accesskey)
                ->where('user_access_key_status','=',1)
                ->where('user_id','=',$userid)->first();
            if(isset($user) && isset(($key)))
            {
               $availableproject = ProjectNotification::where('to_user_id','=',$userid)->get();
               if(count($availableproject) > 0)
               {
               foreach ($availableproject as $value) 
               {
                  $projectid = $value->project_id;
                  $projectstatus = ProjectStatus::where('project_id','=',$projectid)->where('project_status_type_id','=',2)->first();
                    if(!isset($projectstatus))
                    {
                        $project = Project::where('project_id','=',$projectid)->first();
                        $managerid = $project->user_id;
                        $manager = User::where('users_id','=',$managerid)->first();
                        $managerimage = asset("/img/users/" . $manager->users_profile_image);
                        $scope = $project->scope_performed_id;
                        $data = [];
                        $temp = explode(",", $scope);
                        foreach($temp as $scope) 
                        {
                            $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$scope)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                        }
                        $reportduedate = $project['report_due_date'];
                            $datetime2 = new DateTime($reportduedate);
                            $reportduedate= $datetime2->format("Y-m-d");
                            $created_at = (String)$project->created_at;
                            $datetime2 = new DateTime($created_at);
                            $created_at= $datetime2->format("Y-m-d");
                        $projects[] = ['projectid' => (string)$project->project_id, 
                                'projectname' =>  $project->project_name, 
                                'managerimage' => $managerimage,
                                'siteaddress' => $project->project_site_address,
                                'createddate'  => $created_at,
                                'reportduedate' => $reportduedate,
                                'template' => $project->report_template,
                                'instructions' => $project->instructions,
                                'approxbid' =>(String)$project->approx_bid,
                                'latitude' =>(string)$project->latitude,
                                'longitude' =>(string)$project->longitude,
                                'scopeperformed' => $data,
                                ];
                        
                  }
                 
               }
                echo json_encode(array('status' => '1', 'availableprojects' => $projects));
                  exit;

            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "You don't have any available project"));
                exit;
            }
            }
            else
            {
                echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                exit;
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    
}
