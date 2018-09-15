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
                            ->where('bid_status','=',1)
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
                        ->where('bid_status','=',1)
                        ->where('user_id','=',$userid)->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)->count();
                        $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->
                                            where('bid_status','=',1)->get();
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
                $notificationcount = ProjectNotification::where('to_users_id','=',$userid)
                ->where('read_flag','=',0)->count();
                $profileimage = asset("/img/users/" . $user['users_profile_image']);
                if($usertype == 1)
                {
                        $projectcount = Project::where('user_id','=',$userid)->count();
                        $bidmade = ProjectBid::where('project_bid_status','=',1)
                            ->where('bid_status','=',1)->get();
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
                        ->where('bid_status','=',1)
                        ->where('user_id','=',$userid)->count();
                        $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->
                                            where('bid_status','=',1)->get();
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
                    $model->approx_bid = $request['approxbid'];
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
                    $bidmade = ProjectBid::where('project_bid_status','=',1)
                            ->where('bid_status','=',1)
                            ->get();
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
                    ->where('bid_status','=',1)
                    ->where('user_id','=',$userid)->count();
                    $completedproject = ProjectBid::where('user_id','=',$userid)->
                                            where('project_bid_status','=',1)->
                                            where('bid_status','=',1)->get();
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
    Date : 05-09-18
    By   : Suvarna*/
    public function projectdetail(Request $request)
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

                echo json_encode(array('status' => '1',
                                'projectid' => (string)$project->project_id, 
                                'projectname' =>  $project->project_name, 
                                'siteaddress' => $project->project_site_address,
                                'reportduedate' => $project->report_due_date,
                                'template' => $project->report_template,
                                'instructions' => $project->instructions,
                                'approxbid' =>(String)$project->approx_bid,
                                'scopeperformed' => $data));
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
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'reportduedate' => $projectdetail->report_due_date,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'approxbid' =>(String)$projectdetail->approx_bid,
                                'scopeperformed' => $data,
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
                            foreach($temp as $value) 
                            {
                                $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$value)->first();
                                    $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                                    'scope_performed' => $scopeperformed->scope_performed];
                            }
                            $projectdetails[] = ['projectid' => (string)$projectdetail->project_id, 'projectname' =>  $projectdetail->project_name, 
                                'siteaddress' => $projectdetail->project_site_address,
                                'reportduedate' => $projectdetail->report_due_date,
                                'template' => $projectdetail->report_template,
                                'instructions' => $projectdetail->instructions,
                                'approxbid' =>(String)$projectdetail->approx_bid,
                                'scopeperformed' => $data,
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
    
   /* public function storeuserReview(Request $request)
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
                if(isset($request['fromuserid']) && isset($request['touserid']) && isset($request['ratings']))
                {
                    $model = new UserReview;
                    $madel->from_user_id = $request['fromuserid'];
                    $model->to_user_id = (int)$request['touserid'];
                    $model->projectid = (int)$request['projectid'];
                    $model->user_review_ratings = $request['ratings'];
                    if(isset($request['comment']))
                    {
                        $model->user_review_comments = $request['comment'];
                    }
                    $model->save();
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
    }*/

    /*public function managerProfile(Request $request)
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
                if(isset($request['projectid']))
                {
                    $projectid = $request['projectid'];
                    $model = Project::where('project_id','=',$projectid)->first();
                    $managerid = $model->user_id;
                    $manager = User::where('users_id','=',$managerid);

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
    }*/

}
