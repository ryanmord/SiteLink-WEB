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
use App\ProjectNotificationSentDevice;
use App\Setting;
use App\ProjectBidRequest;
use App\EmailVerification;
use App\AssociateType;
use App\ProgressStatusType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Edujugon\PushNotification\Facades\PushNotification;
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
        $errorMsg = array();
        $successMsg = array();
        $model = new User;
        $email = $request['email'];
        $user = User::where('users_email','=',$email)->first();
        if(isset($user)) {
            $errorMsg = array('status' => '0','message' => "User already registered");
            return json_encode($errorMsg);
            exit;
            
        }
        else {
            if(isset($request['email']) && isset($request['name']) && isset($request['phone']) && isset($request['usertype']) && isset($request['company']) && isset($request['password'])) {
                $file = $request->file('image');
                if(isset($file)) {
                    $file = $request->file('image');
                    $destinationPath = public_path('img/users');
                    $image_name = time() . "-" . $file->getClientOriginalName();
                    $path = $file->move($destinationPath, $image_name);
                    $model->users_profile_image = $image_name;
                }
                else{
                    $path = "default.png";
                    $model->users_profile_image = $path;
                }
                $password = $request['password'];
                $model->users_email = $request['email'];
                $model->user_types_id = (int)$request['usertype'];
                $model->users_name = $request['name'];
                if(isset($request['lastname']))
                {
                    $model->last_name = $request['lastname'];
                }
                $model->users_company = $request['company'];
                $model->users_password = Hash::make($password);
                $model->users_phone = $request['phone'];
                if(isset($request['address'])){
                    $model->users_address = $request['address'];
                }
                else{
                    $model->users_address = "-";
                }
                if(isset($request['latitude']) && isset($request['longitude'])) {
                    $model->latitude = $request['latitude'];
                    $model->longitude = $request['longitude'];
                }
                $model->save();
                $user = User::where('users_email','=',$email)->first();
                /*$verifycode = str_random(8);
                $emailverify = new EmailVerification;
                $emailverify->user_id = $user->users_id;
                $emailverify->verification_code = $verifycode;
                $emailverify->status = 1;
                $emailverify->created_at = date('Y-m-d H:i:s');
                $emailverify->save();*/
                $userid = base64_encode($user->users_id);
                //$user_id_d = base64_decode($user_id);
                $url = url('/emailVerification/'.$userid);
                if(isset($request['scope'])){
                    $userid = $user->users_id;
                    $scopeperformed = new UserScopePerformed;
                    $scopeperformed->users_id = $userid;
                    $scopeperformed->scope_performed_id = $request['scope'];
                    $scopeperformed->last_updated = date('Y-m-d H:i:s');
                    $scopeperformed->save();
                }
                $action = 1;
                Mail::to($email)->send(new UserRegistered($user,$url,$action));
                $successMsg = array('status' => '1','message' => "Please check your email for email verification..");
                return json_encode($successMsg);
                exit;
                
            }
            else {
                $errorMsg = array('status' => '0','message' => "Mandatory Parameter is Missing");
                return json_encode($errorMsg);
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
        if(isset($request['email']) && isset($request['password']))
        {
            $user = User::where('users_email','=',$email)->first();
            if(isset($user))
            {
           
                $emailstatus = $user->email_status;
                $usertype = $user->user_types_id;
                /* usertype 1 for project manager and 2 for associate */
                if($usertype == 1)
                {
                    $userapprovalstatus = 1;
                    $errorMsg = array('status' => '0','emailstatus' => '1','message' => "Please login as associate user");
                    return json_encode($errorMsg);
                    exit;

                }
                else
                {
                    $userapprovalstatus  = $user->users_approval_status;
                }
                /* emailstatus 1 for verified email 0 for not verified email*/
                if($emailstatus == 1)
                {
                     /* userapprovalstatus 1 for verified email 2 for not verified request and 0 for rejected*/
                    if($userapprovalstatus == 0)
                    {
                        $errorMsg =  array('status' => '0','emailstatus' => '1','message' => "Sorry your associate request is rejected");
                        return json_encode($errorMsg);
                        exit;
                    }
                    if($userapprovalstatus == 3)
                    {
                        $errorMsg =  array('status' => '0','emailstatus' => '1','message' => "Sorry Your Profile is Blocked");
                        return json_encode($errorMsg);
                        exit;    
                    }
                    if($userapprovalstatus == 1)
                    {
                
                        if(Hash::check($password, $user['users_password']))
                        {
                            $userid = $user->users_id;
                            $username = $user->users_name;
                            $usertype = (string)$user->user_types_id;
                            $userimage = $user->users_profile_image;
                            if(isset($request['callFrom']))
                            {
                                $temp = array('status'       => 1,
                                              'message'      => 'User Login successfully',
                                              'userid'       => $userid,
                                              'usertype'     => $usertype,
                                              'username'     => $username,
                                              'profileImage' => $userimage);
                                return json_encode($temp);
                        
                            }
                            $userdevice = UserDevice::where('user_id','=',$userid)
                            ->where('user_device_unique_id','=',$deviceid)
                            ->where('user_device_type','=',$devicetype)->first();
                            if(isset($userdevice))
                            {
                                $userdeviceid = $userdevice->user_device_id;

                                $accesskey  = str_random(16);
                                $key = UserAccessKey::where('user_id', '=', $userid)
                                                    ->where('user_device_id','=',
                                                            $userdeviceid)
                                                    ->update(['user_access_key_status' => 1,
                                                            'logout_status' => 0,
                                                            'user_access_key' => $accesskey
                                                            ]);

                            }
                            else
                            {
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
                            }
                            
                            $successMsg =  array('status'  => '1',
                                        'message'    => 'User Login successfully',
                                        'privatekey' => $accesskey,
                                        'userid'     => (string)$userid,
                                        'usertype'   => $usertype,
                                        'deviceid'   => (string)$userdeviceid
                                    );
                            return json_encode($successMsg);
                                      
                            exit;
                        }
                        else
                        {
                            return json_encode(array('status' => '0','emailstatus' => '1','message' => "Your password is incorrect"));
                            exit;
                        }
                    }
                    else
                    {
                        return json_encode(array('status' => '0','emailstatus' => '1',
                            'message' => "Please wait for your associate request approval"));
                        exit;
                    }
                }
                else
                {
                    return json_encode(array('status' => '0','emailstatus' => '0','message' => "Please verify your email"));
                    exit;
                }
            }
            else
            {
                return json_encode(array('status' => '0','emailstatus' => '1','message' => "Your emailid is incorrect"));
                exit;
            }
        }
        else
        {
            return json_encode(array('status' => '0','emailstatus' => '1','message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : Dashboard
    Url  :http://103.51.153.235/project_management/public/index.php/api/dashboard
    Date : 02-09-18
    By   : Suvarna*/
    public function dashboard(Request $request)
    {
       
        $user =$this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $username = $user->users_name;
        $lastname = $user->last_name;
        if($lastname == null)
        {
            $lastname = '';
        }
        else
        {
            $username = $username.' '.$lastname;
        }
        $usertype = $user->user_types_id;
        $notificationcount = ProjectNotification::where('to_user_id','=',$userid)
                ->where('read_flag','=',0)->count();
        $profileimage = asset("/img/users/" . $user['users_profile_image']);
        /* 1 usertype for project manager and 2 for associate*/
        /*if($usertype == 1)
        {
            $projectcount = Project::where('user_id','=',$userid)->count();
            $bidmade = ProjectBid::where('project_bid_status','<>',0)
                                    ->where('bid_status','=',1)->get();
            $bidmadecount = 0;
            foreach($bidmade as  $value) 
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
            foreach($completedproject as $value) 
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
            $progresscount = 0;
            $project = Project::where('user_id','=',$userid)->get();
            foreach($project as $value) 
            {
                $reportduedate = $value->report_due_date;
                $reportduedate = new DateTime($reportduedate);
                $reportduedate= $reportduedate->format("Y-m-d");
                $projectstatus = ProjectStatus::where('project_id','=',$value->project_id)
                                 ->get();
                foreach($projectstatus as  $status) 
                {
                    $currentstatus = $status->project_status_type_id;
                }

                if($currentstatus == 3 || $currentstatus == 6)
                {
                    $todaydate = date('Y-m-d');
                    
                    if($todaydate > $reportduedate)
                    {
                        $overdueprojectcount = $overdueprojectcount + 1;
                    }
                                
                }
                else
                {
                    $progresscount = $progresscount + 1;
                }

            }
        }
        else
        {*/
            $associateTypeId = $user->associate_type_id;
            $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
            $projectcount = ProjectBid::where('user_id','=',$userid)
                                        ->where('project_bid_status','=',1)->count();
            $bidmadecount = ProjectBid::where('project_bid_status','<>',0)
                                        ->where('bid_status','=',1)
                                        ->where('user_id','=',$userid)->count();
           /* $completedproject = ProjectBid::where('user_id','=',$userid)
                                        ->where('project_bid_status','=',1)->get();*/
            $completedprojectcount = DB::table('project_bids')
                                    ->leftJoin('project_status', 'project_bids.project_id', '=', 'project_status.project_id')
                                    ->where('project_bids.user_id','=',$userid)
                                    ->where('project_bid_status','=',1)
                                    ->where('project_status.project_status_type_id','=',4)
                                    ->count();
            $overdueprojectcount = 0;
            $progresscount = 0;
            $projectbid = ProjectBid::where('user_id','=',$userid)
                                    ->where('project_bid_status','=',1)
                                    ->get();
            if(count($projectbid) > 0)
            {
                foreach($projectbid as $value) 
                {
                    $currentproject = Project::where('project_id','=',$value->project_id)->first();
                    $reportduedate = $currentproject->report_due_date;
                    $reportduedate = new DateTime($reportduedate);
                    $reportduedate= $reportduedate->format("Y-m-d");
                    $projectstatus = ProjectStatus::where('project_id','=',$value->project_id)->get();
                    foreach($projectstatus as  $status) 
                    {
                        $currentstatus = $status->project_status_type_id;
                    }
                    if($currentstatus == 3 || $currentstatus == 6)
                    {
                        $todaydate = date('Y-m-d');
                        
                        if($todaydate > $reportduedate)
                        {
                            $overdueprojectcount = $overdueprojectcount + 1;
                        }
                                
                    }
                    else
                    {
                        $progresscount = $progresscount + 1;
                    }
                }
            }

        //}
         
        $totalproject = $projectcount;
        if($totalproject > 0)
        {
            $progresscount = $progresscount + $overdueprojectcount;
            $progresspercentage = ($progresscount * 100) / $totalproject;
            $completedpercentage = ($completedprojectcount * 100) / $totalproject;;
        }
        else
        {
            $totalproject = '0';
            $progresspercentage = '0';
            $completedpercentage = '0';
        }
        if($totalproject < 10 && $totalproject > 0)
        {
            $totalproject = '0'.(string)$totalproject;
        }
        if($bidmadecount < 10)
        {
            $bidmadecount = '0'.(string)$bidmadecount;
        }
        if($completedprojectcount < 10)
                    {
            $completedprojectcount = '0'.(string)$completedprojectcount;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        $temp = array('status'                => '1',
                      'username'              => $username,
                      'associateType'         => $associateType->associate_type,
                      'profileimage'          => $profileimage,
                      'totalproject'          => (string)$totalproject,
                      'bidmadecount'          => (string)$bidmadecount,
                      'completedprojectcount' => (string)$completedprojectcount,
                      'overdueprojectcount'   => (string)$overdueprojectcount,
                      'notificationcount'     => (string)$notificationcount,
                      'progresspercentage'    => (string)$progresspercentage,
                      'completedpercentage'   => (string)$completedpercentage);
        
        return json_encode($temp);
        exit;
                
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
            $verifycode = $request['verifycode'];
            $user = User::where('users_email','=',$email)->first();
            if(isset($user))
            {
                $emailverification = EmailVerification::where('user_id','=',$user->users_id)->first();
                $date1=date("Y-m-d H:i:s");
                $date2= date($emailverification->created_at);
                $datetime1 = new DateTime($date1);
                $datetime2 = new DateTime($date2);
                $date= $datetime2->format("m-d-Y");
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');
                if($days > 0)
                {
                    $flag = EmailVerification::where('user_id', '=', $user->users_id)
                    ->update(['status' => 0]);
                    echo json_encode(array('status' => '0','message' => "Verification code was valid for 24 hours please click on resend"));
                    exit;

                }
                $verification = EmailVerification::
                                where('user_id', '=', $user->users_id)
                                ->where('verification_code','=',$verifycode)
                                ->where('status','=',1)->first();
                if(isset($verification)) 
                {
                    $flag = User::where('users_email', '=', $email)
                    ->update(['email_status' => 1]);
                    echo json_encode(array('status' => '1','message' => "email verification successfully"));
                    exit;
                }
                else
                {
                    echo json_encode(array('status' => '0','message' => "Verification code doesn't match"));
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
                
                $verifycode = str_random(8);
                $date = date('Y-m-d H:i:s');
                $model = EmailVerification::where('user_id', '=',$user->users_id)
                        ->update(['verification_code' => $verifycode,
                                'status' => 1,
                                'created_at' => $date]);
                if(isset($model))
                {
                    $action = 1;
                    Mail::to($email)->send(new UserRegistered($user,$verifycode,$action));
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
        if(isset($request['password']) && isset($request['userid']) &&isset($request['oldpassword']))
        {

            $userid = $request['userid'];
            $accesskey = $request['privatekey'];
            $password = $request['password'];
            $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
            $oldpassword = $request['oldpassword'];
            if(Hash::check($oldpassword, $user->users_password))
            {
                $hashpassword = Hash::make($password);
                $model = User::where('users_id', '=',$userid)
                            ->update(['users_password' => $hashpassword]);
                return json_encode(array('status' => '1','message' => "Password changed successfully"));
                exit;
            }
            else
            {
                return json_encode(array('status' => '0','message' => "Old password is incorrect"));
                exit;
            }
        }
        else
        {
            return json_encode(array('status' => '0','message' => "Mandatory field  is required"));
            exit;
        }

    }
    /*Name : Myprofile
    Url  :http://103.51.153.235/project_management/public/index.php/api/getProfile?userid=153&privatekey=z6nRHY3Gc4AzBXH0
    Date : 30-08-18
    By   : Suvarna*/
    public function getprofile(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $profileimage = asset("/img/users/" . $user['users_profile_image']);
        $name    = $user->users_name;
        $lastname = $user->last_name;
        if($lastname == null)
        {
            $lastname = '';
        }
        $company = $user->users_company;
        $email   = $user->users_email;
        $phone   = $user->users_phone;
        if($user->user_types_id == 2)
        {
            $address = $user->users_address;
            $latitude = $user->latitude;
            $longitude = $user->longitude;
            $associateTypeId = $user->associate_type_id;
            $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
            $scopeid = DB::select(DB::raw("SELECT sp.scope_performed_id
                                FROM user_scope_performed sp,users u
                                WHERE sp.users_id = u.users_id
                                AND sp.users_id = $userid;
                                "));
            $scope = $scopeid[0]->scope_performed_id;
            $data = $this->getscopeperformed($scope);
            $temp = array('status'         => '1',
                          'profileimage'   => $profileimage,
                          'name'           => $name,
                          'lastname'       => $lastname,
                          'associateType'  => $associateType->associate_type,
                          'company'        => $company,
                          'email'          => $email,
                          'phone'          => $phone,
                          'address'        => $address,
                          'latitude'       => $latitude,
                          'longitude'      => $longitude,
                          'scopeperformed' => $data,
                        );
           
            return json_encode($temp);
            exit;
        }
        else
        {
            return json_encode(array('status'      => '1',
                                  'profileimage' => $profileimage,
                                  'name'         => $name,
                                  'lastname'     => $lastname,
                                  'company'      => $company,
                                  'email'        => $email,
                                  'phone'        => $phone,
                                  ));
            exit;
        }
    }
    /*Name : Update Profile
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateProfile?userid=153&privatekey=1SQTsAHCnM5UWB87&company=magneto&scopeperformed=1,2,3
    Date : 01-09-18
    By   : Suvarna*/
    public function updateprofile(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(isset($request['name']))
        {
            $name  = $request['name'];
            $model = User::where('users_id', '=',$userid)
                            ->update(['users_name' => $name]);
        }
        if(isset($request['lastname']))
        {
            $lastname  = $request['lastname'];
            $model = User::where('users_id', '=',$userid)
                            ->update(['last_name' => $lastname]);
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
            $oldlat = $user->latitude;
            $oldlong = $user->longitude;
            if($latitude != $oldlat && $longitude != $oldlong)
            {
                $date = date('Y-m-d H:i:s');
                $model = User::where('users_id','=',$userid)
                            ->update(['latitude' => $latitude,
                                    'longitude' => $longitude,
                                    'lat_long_updated_at' => $date]);
                $this->updateavailableProject($userid);
            }
            
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
            if($image !='default.png')
            {
                if(file_exists(public_path('img/users/'.$image)))
                {
                    unlink(public_path('img/users/'.$image));
                }
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
        return json_encode(array('status' => '1','message' => "Profile updated successfully"));
        exit;
       
    }
    /*Name : Get user availability and notifaction setting value
    Url  :http://103.51.153.235/project_management/public/index.php/api/getSettings?userid=153&privatekey=1SQTsAHCnM5UWB87
    Date : 01-09-18
    By   : Suvarna*/
    public function getsettings(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $model = User::where('users_id', '=',$userid)->first();
        $availabilityflag = (string)$model->users_status;
        $notificationflag = (string)$model->notification_enable;
        $setting[] = array('availabilityflag' => $availabilityflag,'notificationflag' => $notificationflag);
        return json_encode(array('status' => '1','availabilityflag' => $availabilityflag,
                    'notificationflag' => $notificationflag,'setting' => $setting));
        exit;
    }
    /*Name : Update user notification and availabilty Settings
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateSettings?userid=153&privatekey=1SQTsAHCnM5UWB87
    Date : 01-09-18
    By   : Suvarna*/
    public function updateSettings(Request $request)
    {
        
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['notification']) && !isset($request['availability']))
        {
            return json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
        $notificationflag = (int)$request['notification'];
        $availabilityflag = (int)$request['availability'];
        $model = User::where('users_id', '=',$userid)
                ->update(['users_status' => $availabilityflag]);
        $model = User::where('users_id', '=',$userid)
                ->update(['notification_enable' => $notificationflag]);
        return json_encode(array('status' => '1','message' => "Update Settings successfully"));
        exit;
    }
    /*Name : Forgot password for user
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
                return json_encode(array('status' => '1','message' => "password reset link send on your email..please check your email"));
                exit;
            }
            else
            {
                return json_encode(array('status' => '0', 'message' => "Your email is not register with us"));
                exit;
            }
           
           
        }
        else
        {
            return json_encode(array('status' => '0', 'message' => "Email Id is required"));
            exit;
        }
    }
    /*Name : Create Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/createProject?userid=153&privatekey=krzzpdel813p0Dip
    Date : 02-09-18
    By   : Suvarna*/
    public function createProject(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
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
            if(isset($request['onsitedate']))
            {
                $model->on_site_date = new DateTime($request['onsitedate']);
            }
            $model->approx_bid = (double)$request['approxbid'];
            $model->save();
            $project = Project::where('user_id','=',$userid)
                    ->where('project_name','=',$request['projectname'])->get();
            foreach($project as $value) 
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
            $notificationtext = 'New Job available for bid';
            $notificationtype = '1';
            $fromuserid = $userid;
            $body = $request['projectname'];
            $title = 'New Job available for bid';

            foreach($result as $value) 
            {
                $touserid = $value->users_id;
                $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                $bidrequest = new ProjectBidRequest();
                $bidrequest->project_id = $projectid;
                $bidrequest->to_user_id = $value->users_id;
                $bidrequest->from_user_id = $userid;
                $bidrequest->created_at = date('Y-m-d H:i:s');
                $bidrequest->save();
            }
            echo json_encode(array('status' => '1', 'message' => 'Project created successfully'));
            exit;
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;
        }
    }
    /*Name : get user profile detail
    Url  :http://103.51.153.235/project_management/public/index.php/api/userProfile?userid=170&privatekey=mVrhsbUfylAFTtqI
    Date : 03-09-18
    By   : Suvarna*/
    public function userprofile(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $user->users_id;
        $username = $user->users_name;
        $lastname = $user->last_name;
        if($lastname == null)
        {
            $lastname = '';
        }
        else
        {
            $username = $username.' '.$lastname;
        }
        
        $usertype = $user->user_types_id;
        $profileimage = asset("/img/users/" . $user->users_profile_image);
        if($usertype == 1)
        {
            $bidmade = ProjectBid::where('project_bid_status','<>',0)
                                ->where('bid_status','=',1)->get();
            $bidmadecount = 0;
            foreach($bidmade as  $value) 
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
            foreach($completedproject as $value) 
            {
                $projectid = $value->project_id;
                $model = ProjectStatus::where('project_id','=',$projectid)
                                        ->where('project_status_type_id','=',4)->get();
                if(count($model)>0)
                {
                    $completedprojectcount = $completedprojectcount + 1;
                }
            }
            $overdueprojectcount = 0;
            $project = Project::where('user_id','=',$userid)->get();
            foreach($project as $value) 
            {
                $projectid = $value->project_id;
                $reportduedate = $value->report_due_date;
                $reportduedate = new DateTime($reportduedate);
                $reportduedate= $reportduedate->format("Y-m-d");
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                                ->get();
                foreach ($projectstatus as  $status) 
                {
                    $currentstatus = $status->project_status_type_id;
                }
                if($currentstatus == 3 || $currentstatus == 6)
                {
                    $todaydate = date('Y-m-d');
                           
                    if($todaydate > $reportduedate)
                    {
                        $overdueprojectcount = $overdueprojectcount + 1;
                    }
                                
                }

            }
        }
        else
        {
            
            $associateType = AssociateType::where('associate_type_id','=',$user->associate_type_id)->first();
            $projectcount = ProjectBid::where('user_id','=',$userid)
                                        ->where('project_bid_status','=',1)->count();
                    
            $bidmadecount = ProjectBid::where('bid_status','=',1)
                                        ->where('project_bid_status','<>',0)
                                        ->where('user_id','=',$userid)->count();
            $completedprojectcount = DB::table('project_bids')
                                    ->leftJoin('project_status', 'project_bids.project_id', '=', 'project_status.project_id')
                                    ->where('project_bids.user_id','=',$userid)
                                    ->where('project_status.project_status_type_id','=',4)->count();
            
            $overdueprojectcount = 0;
            $projectbid = ProjectBid::where('user_id','=',$userid)->
                                    where('project_bid_status','=',1)->get();
            if(count($projectbid) > 0)
            {
                foreach($projectbid as $value) 
                {
                    $projectid = $value->project_id;
                    $project = Project::where('project_id','=',$projectid)
                                        ->first();
                    $reportduedate = $project->report_due_date;
                    $reportduedate = new DateTime($reportduedate);
                    $reportduedate= $reportduedate->format("Y-m-d");
                    $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                 ->get();
                    foreach ($projectstatus as  $status) 
                    {
                        $currentstatus = $status->project_status_type_id;
                    }
                    if($currentstatus == 3 || $currentstatus == 6)
                    {
                        $todaydate = date('Y-m-d');
                                
                        if($todaydate > $reportduedate)
                        {
                            $overdueprojectcount = $overdueprojectcount + 1;
                        }
                                
                    }

                }
            }
                       
        }
        $review = UserReview::where('to_user_id','=',$userid)->
                            where('user_review_status','=',1)->max('user_review_ratings');
        if(!isset($review))
        {
            $review = '0.0';
        }
        if($bidmadecount < 10)
        {
            $bidmadecount = '0'.(string)$bidmadecount;
        }
        if($completedprojectcount < 10)
        {
            $completedprojectcount = '0'.(string)$completedprojectcount;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        $jobscompleted = (string)$completedprojectcount;
        $totalbidcount = (string)$bidmadecount;
        $overdueproject = (string)$overdueprojectcount;
        $rating = (string)$review;
        $myprofile = array($jobscompleted,$totalbidcount,$overdueproject,$rating);
        $temp = array('status'                => '1',
                      'username'              => $username,
                      'associateType'         => $associateType->associate_type,
                      'profileimage'          => $profileimage,
                      'bidmadecount'          => (string)$bidmadecount,
                      'completedprojectcount' => (string)$completedprojectcount,
                      'overdueprojectcount'   => (string)$overdueprojectcount,
                      'review'                => (string)$review,
                      'myprofile'             => $myprofile);
        
        return json_encode($temp);
        exit;
    }
    /*Name : user Review 
    Url  :http://103.51.153.235/project_management/public/index.php/api/userReview?userid=170&privatekey=agi7heyEv2xtcYYb
    Date : 04-09-18
    By   : Suvarna*/
    public function userReview(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            return json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $review = DB::table('user_reviews')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS user_review_id'),
                             'user_review_id', 'from_user_id','user_review_comments','created_at','user_review_ratings'
                           )
                            ->where('to_user_id','=',$userid)
                            ->where('user_review_status','=',1)
                            ->orderBy('user_review_id', 'desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $review->count();
        $cntreviews = 0;
        $totalNotifications = 0;
        if($count != 0) 
        { 
            foreach ($review as $value)
            {
                $byuserid = $value->from_user_id;
                $model = User::where('users_id','=',$byuserid)->first();
                $lastname = $model->last_name;
                $username = $model->users_name.' '.$lastname;
                $profileimage = asset("/img/users/" . $model['users_profile_image']);
                $commentdate = $value->created_at;
                $commentdate = new DateTime($commentdate);
                $commentdate = $commentdate->format("jS F Y h:i:s");
                $userreview[] = ['profileimage' => $profileimage, 
                                'username'      =>  $username, 
                                'rating'        => (string)$value->user_review_ratings,
                                'comment'       => $value->user_review_comments,
                                'commentdate'   => $commentdate];
                $cntreviews += 1;
            }
            if(isset($review)) {
                $itemsremaining = $totalRemaingItems - $limit;
                if ($totalRemaingItems > 0) {
                    if ($itemsremaining < 0) {
                        $itemsremaining = 0;
                    }
                }
            }
            if(isset($userreview))
            {
                $temp = array('status'        => '1', 
                            'nextpagenumber' => $start,
                            'reviewcount'    => (string)$cntreviews,
                            'itemsremaining' => $itemsremaining,
                            'userreview'     => $userreview);
             
                
                return json_encode($temp);
                exit;
            }
            else
            {
                return json_encode(array('status' => '1', 'message' => "There are no review available"));
                exit;
            }
                    
        } 
        else
        {
            $temp = array('status' => '0', 'message' => "There are no review available");
           
            return json_encode($temp);
            exit;
            
        }
            

    }
    /*Name : user Logout 
    Url  :http://103.51.153.235/project_management/public/index.php/api/        userLogout?userid=182&privatekey=WLhJOYbfdjdN9s9R&deviceid=498
    Date : 04-09-18
    By   : Suvarna*/
    public function logout(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $accesskey = $request['privatekey'];
        $userid = $request['userid'];
        $devicetype = $request['devicetype'];
        $userdeviceid = $request['deviceid'];
        $date = date('Y-m-d H:i:s');
        $model = UserAccessKey::where('user_access_key', '=',$accesskey)
                        ->where('user_id', '=',$userid)
                        ->where('user_device_id', '=',$userdeviceid)
                        ->update(['logout_status' => 1,'user_access_key_status' => 0,
                                'logout_datetime' => $date]);
        echo json_encode(array('status' => '1','message' => "Logout successfully"));
        exit;
    }
    /*Name : publish project
    Url  :http://103.51.153.235/project_management/public/index.php/api/publishProject?userid=170&privatekey=agi7heyEv2xtcYYb
    Date : 04-09-18
    By   : Suvarna*/
    public function publishProject(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $project = Project::where('user_id','=',$userid)
                            ->orderBy('project_id', 'desc')->get();
        $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('projects.user_id','=',$userid)
                        ->groupBy('project_status.project_id')
                        ->havingRaw('COUNT(project_status_type_id) = 1')
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $projects->count();
        $cntprojects = 0;
        $totalprojects = 0;
        if($count != 0)
        {
            foreach($projects as $value)
            {
                $projectid = $value->project_id;
                $publishproject = Project::where('project_id','=',$value->project_id)->first();
                $scope = $publishproject->scope_performed_id;
                $data = $this->getscopeperformed($scope);
                if(isset($publishproject['on_site_date']))
                {
                    $onsitedate = (string)$publishproject['on_site_date'];
                    $datetime2 = new DateTime($onsitedate);
                    $onsitedate= $datetime2->format("Y-m-d");
                }
                else
                {
                    $onsitedate = '';
                }
                $reportduedate = $publishproject['report_due_date'];
                $datetime2 = new DateTime($reportduedate);
                $reportduedate= $datetime2->format("Y-m-d");
                $created_at = (String)$publishproject->created_at;
                $datetime2 = new DateTime($created_at);
                $created_at= $datetime2->format("Y-m-d");
                $projectbidcount = ProjectBid::where('project_id','=',$projectid)
                                                ->where('project_bid_status','=',2)
                                                ->where('bid_status','=',1)->count();
                $approxbid = number_format($publishproject->approx_bid, 2);
                $publishprojects[] = ['projectid' => (string)$publishproject->project_id, 
                                'projectname'     =>  $publishproject->project_name, 
                                'siteaddress'     => $publishproject->project_site_address,
                                'createddate'     => $created_at,
                                'onsitedate'      => $onsitedate,
                                'reportduedate'   => $reportduedate,
                                'template'        => $publishproject->report_template,
                                'instructions'    => $publishproject->instructions,
                                'approxbid'       =>(String)$approxbid,
                                'projectbidcount' =>(string)$projectbidcount,
                                'scopeperformed'  => $data,
                                ];
                $cntprojects += 1;
            }
        }
        if (!empty($projects)) 
        {
            $itemsremaining = $totalRemaingItems - $limit;
            if ($totalRemaingItems > 0) 
            {
                if ($itemsremaining < 0) 
                {
                    $itemsremaining = 0;
                }
                echo json_encode(array('status'          => '1', 
                                       'nextpagenumber'  => $start, 
                                       'projectcount'    => (string)$cntprojects,
                                       'itemsremaining'  => $itemsremaining,
                                       'publishprojects' => $publishprojects));
                exit;
            }
            else 
            {
                echo json_encode(array('status' => '0', 'message' => "There are no Jobs available"));
                exit;
            }
        }

        else 
        {
            echo json_encode(array('status' => '0', 'message' => "There are no Jobs available"));
            exit;
        }
    }
    /*Name : Project Detail 
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectDetail?userid=182&privatekey=SsngS44DXdSCz2WK&projectid=14
    Date : 14-09-18
    By   : Suvarna*/
    public function projectDetail(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        $project = Project::where('project_id','=',$projectid)->first();
        $scope = $project->scope_performed_id;
        $data = $this->getscopeperformed($scope);
        if(isset($project->on_site_date))
        {
            $onsitedate = (string)$project->on_site_date;
            $datetime2 = new DateTime($onsitedate);
            $onsitedate= $datetime2->format("Y-m-d");
        }
        else
        {
            $onsitedate = '';
        }
        $reportduedate = (string)$project->report_due_date;
        $datetime2 = new DateTime($reportduedate);
        $reportduedate= $datetime2->format("Y-m-d");
        $createddate = (string)$project->created_at;
        $datetime2 = new DateTime($createddate);
        $createddate1 = $datetime2->format("Y-m-d");
        if($user->user_types_id != 1)
        {
            $associateTypeId = $user->associate_type_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
                                ->where('bid_status','=',1)
                                ->where('user_id','=',$userid)
                                ->get();
            $countbid = $projectbid->count();
            $jobReachCount = ProjectBidRequest::where('project_id','=',$projectid)->count();
            if($countbid != 0)
            {
                foreach ($projectbid as $value) 
                {
                    $previousbid = $value->associate_suggested_bid;
                    if($value->project_bid_status == 0)
                    {
                        $rejectdate = (string)$value->accepted_rejected_at;
                        $datetime2 = new DateTime($rejectdate);
                        $biddate= $datetime2->format("Y-m-d");
                            
                        $bidstatus = 'BID REJECTED';
                        $bidstatusflag = '0';
                    }
                    else
                    {
                        $createddate = (string)$value->created_at;
                        $datetime2 = new DateTime($createddate);
                        $biddate= $datetime2->format("Y-m-d");
                        $bidstatus = 'AWAITING RESPONSE';
                        $bidstatusflag = '2';
                    }
                    $createddate = (string)$value->created_at;
                    $datetime2 = new DateTime($createddate);
                    $applydate = $datetime2->format("Y-m-d");
                }
                $finalbid = ProjectBid::where('project_id','=',$projectid)
                                        ->where('project_bid_status','=',1)->first();
                if(isset($finalbid))
                {
                    $finalbid1 =(string)$finalbid->associate_suggested_bid;
                    $review = userReview::where('to_user_id','=',$userid)
                                        ->where('project_id','=',$projectid)->first();
                    if(isset($review))
                    {
                        $rating = $review->user_review_ratings;
                        $comment = $review->user_review_comments;
                        $approxbid = number_format($project->approx_bid, 2);
                        $temp = array(
                                        'status'         => '1',
                                        'projectid'      => (string)$project->project_id, 
                                        'projectname'    =>  $project->project_name, 
                                        'siteaddress'    => $project->project_site_address,
                                        'latitude'       => $project->latitude,
                                        'longitude'      => $project->longitude,
                                        'milesrange'     => (string)$project->milesrange,
                                        'createddate'    => $createddate1,
                                        'onsitedate'     => $onsitedate,
                                        'reportduedate'  => $reportduedate,
                                        'template'       => (string)$project->report_template,
                                        'instructions'   => $project->instructions,
                                        'approxbid'      =>(String)$approxbid,
                                        'finalbid'       => (string)$finalbid1,
                                        'rating'         => (string)$rating,
                                        'comment'        => $comment,
                                        'scopeperformed' => $data,
                                        'jobReachCount'  => $jobReachCount,
                                        'associateTypeId'=> $associateTypeId);
                       
                        return json_encode($temp);
                        exit;
                    }
                }
                $previousbid = number_format($previousbid, 2);
                $previousbid = (string)$previousbid;
            }
            else
            {
                $previousbid = '0';
                $biddate = '';
                $bidstatus = '';
                $applydate = '';
                $bidstatusflag = '';
            }
            $approxbid = number_format($project->approx_bid, 2);
            
            $temp = array('status'     => '1',
                                'projectid'         => (string)$project->project_id, 
                                'projectname'       =>  $project->project_name, 
                                'siteaddress'       => $project->project_site_address,
                                'latitude'          => $project->latitude,
                                'longitude'         => $project->longitude,
                                'milesrange'        => (string)$project->milesrange,
                                'createddate'       => $createddate1,
                                'onsitedate'        => $onsitedate,
                                'reportduedate'     => $reportduedate,
                                'template'          => (string)$project->report_template,
                                'instructions'      => $project->instructions,
                                'approxbid'         => (String)$approxbid,
                                'previousbid'       => (string)$previousbid,
                                'applydate'         => (string)$applydate,
                                'biddate'           => (string)$biddate,
                                'bidstatus'         => (string)$bidstatus,
                                'bidstatusflag'     => $bidstatusflag,
                                'scopeperformed'    => $data,
                                'jobReachCount'     => $jobReachCount,
                                'associateTypeId'   => $associateTypeId);
            
            return json_encode($temp);
            exit;
        }
        else
        {
            $bidcount = ProjectBid::where('project_id','=',$projectid)
                                    ->where('bid_status','=',1)
                                    ->where('project_bid_status','=',2)->count();
            $approxbid = number_format($project->approx_bid, 2);
            $temp = array('status'      => '1',
                                'projectid'      => (string)$project->project_id, 
                                'projectname'    =>  $project->project_name, 
                                'siteaddress'    => $project->project_site_address,
                                'latitude'       => $project->latitude,
                                'longitude'      => $project->longitude,
                                'milesrange'     => (string)$project->milesrange,
                                'createddate'    => $createddate1,
                                'onsitedate'     => $onsitedate,
                                'reportduedate'  => $reportduedate,
                                'template'       => (string)$project->report_template,
                                'instructions'   => $project->instructions,
                                'approxbid'      => (String)$approxbid,
                                'bidcount'       => (string)$bidcount,
                                'scopeperformed' => $data);
           
            return json_encode($temp);
            exit;
            
        }
            
    }
    /*Name :  Project history
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectHistory?userid=182&privatekey=SsngS44DXdSCz2WK
    Date : 05-09-18
    By   : Suvarna*/
    public function projectHistory(Request $request,$searchKeyword = "")
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            return json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1); 
        $usertype = $user->user_types_id;
        if($usertype == 1)
        {
            $projects = DB::table('projects')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS projects.project_id'),'projects.project_id','projects.project_name','projects.user_id','projects.project_site_address','projects.on_site_date','projects.report_due_date','projects.instructions','projects.approx_bid','projects.report_template','projects.scope_performed_id','projects.created_at','projects.updated_at','project_status.project_status_type_id')
                        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('projects.user_id','=',$userid)
                        ->whereIn('project_status.project_status_type_id',[4,5])
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();   
            $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
            $totalRemaingItems = $count[0]->Totalcount - $items;
            $count = $projects->count();
            $cntproject = 0;
            $totalprojects = 0;
            if($count != 0)
            {
                foreach($projects as $value)
                {
                    $scope = $value->scope_performed_id;
                    $data = $this->getscopeperformed($scope);
                    $projectid = $value->project_id;
                    $review = UserReview::where('project_id','=',$projectid)->first();
                    if(isset($review))
                    {
                        $rating = $review->user_review_ratings;
                        $comment = $review->user_review_comments;
                    }
                    else
                    {
                        $rating = '0.0';
                        $comment = '';
                    }
                    if($value->project_status_type_id == 5)
                    {
                        $statuslabel = 'CANCELLED';
                        $flag = '0';
                    }
                    else
                    {
                        $statuslabel = 'COMPLETED';
                        $flag = '1';
                    }
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                                            ->where('project_bid_status','=',1)->first();
                    $finalbid = $projectbid->associate_suggested_bid;
                    if(isset($value->on_site_date))
                    {
                        $onsitedate = (string)$value->on_site_date;
                        $datetime2 = new DateTime($onsitedate);
                        $onsitedate= $datetime2->format("Y-m-d");
                    }
                    else
                    {
                        $onsitedate = '';
                    }
                    $createddate = (string)$value->created_at;
                    $datetime2 = new DateTime($createddate);
                    $createddate= $datetime2->format("Y-m-d");
                    $reportduedate = (string)$value->report_due_date;
                    $datetime2 = new DateTime($reportduedate);
                    $reportduedate= $datetime2->format("Y-m-d");
                    $approxbid = number_format($value->approx_bid, 2);
                    $finalbid = number_format($finalbid, 2);
                    $projectdetails[] = ['projectid'     => (string)$value->project_id, 
                                        'projectname'    =>  $value->project_name, 
                                        'siteaddress'    => $value->project_site_address,
                                        'createddate'    => $createddate,
                                        'onsitedate'     => $onsitedate,
                                        'reportduedate'  => $reportduedate,
                                        'template'       => $value->report_template,
                                        'instructions'   => $value->instructions,
                                        'suggestedbid'   =>(String)$approxbid,
                                        'finalbid'       => (string)$finalbid,
                                        'scopeperformed' => $data,
                                        'rating'         => $rating,
                                        'comment'        => $comment,
                                        'statuslabel'    => $statuslabel,
                                        'flag'           => $flag
                                        ];
                    $cntproject += 1;
                }
                if (!empty($projects)) 
                {
                    $itemsremaining = $totalRemaingItems - $limit;
                    if ($totalRemaingItems > 0) 
                    {
                        if ($itemsremaining < 0) 
                        {
                            $itemsremaining = 0;
                        }

                        return json_encode(array('status' => '1', 'nextpagenumber' => $start, 'projectcount' => (string)$cntproject,'itemsremaining' => $itemsremaining,'projects' => $projectdetails));
                        exit;
                    }
                    else
                    {
                        return json_encode(array('status' => '1', 'message' => "There are no job available"));
                        exit;
                    }
                }
                else 
                {
                    return json_encode(array('status' => '0', 'message' => "There are no job available"));
                    exit;
                }
                
            }
            else
            {
                    return json_encode(array('status' => '0', 'message' => "There are no job available"));
                    exit;
                }
            }
            else
            {
                $where_condition = "1 = 1";
               

                if ($searchKeyword != "") {

                $where_condition = "(projects.project_name Like  '%$searchKeyword%')";
                
                $projects = $projects = DB::table('project_bids')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_bids.project_id'),'project_bids.project_id','project_status.project_status_type_id','project_bids.user_id','project_bids.project_bid_status')
                        ->leftJoin('project_status', 'project_bids.project_id', '=', 'project_status.project_id')
                        ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('project_bids.user_id','=',$userid)
                        ->where('project_bids.project_bid_status','=',1)
                        ->whereIn('project_status.project_status_type_id',[4,5])
                        ->whereRaw($where_condition)
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get(); 

                }
                else{
                    $projects = DB::table('project_bids')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_bids.project_id'),'project_bids.project_id','project_status.project_status_type_id','project_bids.user_id','project_bids.project_bid_status')
                        ->leftJoin('project_status', 'project_bids.project_id', '=', 'project_status.project_id')
                        ->where('project_bids.user_id','=',$userid)
                        ->where('project_bids.project_bid_status','=',1)
                        ->whereIn('project_status.project_status_type_id',[4,5])
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();   
                }
               
                $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
                $totalRemaingItems = $count[0]->Totalcount - $items;
                $count = $projects->count();
                $cntproject = 0;
                $totalprojects = 0;
               
                if ($count != 0) 
                {
                    foreach($projects as $value)
                    {
                        $projectid = $value->project_id;
                        $project = Project::where('project_id','=',$projectid)->first();
                        $scope = $project->scope_performed_id;
                        $data = $this->getscopeperformed($scope);
                        if($value->project_status_type_id == 5)
                        {
                            $statuslabel = 'CANCELLED';
                            $flag = '0';
                        }
                        else
                        {
                            $statuslabel = 'COMPLETED';
                            $flag = '1';
                        }
                        $review = UserReview::where('project_id','=',$projectid)->first();
                        if(isset($review))
                        {
                            $rating = $review->user_review_ratings;
                            $comment = $review->user_review_comments;
                        }
                        else
                        {
                            $rating = '0.0';
                            $comment = '';
                        }
                        $projectbid = ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=',1)->first();
                        $finalbid = $projectbid->associate_suggested_bid;
                        if(isset($project->on_site_date))
                        {
                            $onsitedate = (string)$project->on_site_date;
                            $datetime2 = new DateTime($onsitedate);
                            $onsitedate= $datetime2->format("Y-m-d");
                        }
                        else
                        {
                            $onsitedate = '';
                        }
                        $createddate = (string)$project->created_at;
                        $datetime2 = new DateTime($createddate);
                        $createddate= $datetime2->format("Y-m-d");
                        $reportduedate = (string)$project->report_due_date;
                        $datetime2 = new DateTime($reportduedate);
                        $reportduedate= $datetime2->format("Y-m-d");
                        $approxbid = number_format($project->approx_bid, 2);
                        $finalbid = number_format($finalbid, 2);
                        $projectdetails[] = ['projectid' => (string)$project->project_id, 
                                'projectname'    =>  $project->project_name, 
                                'siteaddress'    => $project->project_site_address,
                                'createddate'    => $createddate,
                                'onsitedate'     => $onsitedate,
                                'reportduedate'  => $reportduedate,
                                'template'       => $project->report_template,
                                'instructions'   => $project->instructions,
                                'suggestedbid'   =>(String)$approxbid,
                                'finalbid'       => (string)$finalbid,
                                'scopeperformed' => $data,
                                'rating'         => $rating,
                                'comment'        => $comment,
                                'statuslabel'    => $statuslabel,
                                'flag'           => $flag
                                ];
                        $cntproject += 1;
                    }
                    if (!empty($projects)) 
                    {
                        $itemsremaining = $totalRemaingItems - $limit;
                        if ($totalRemaingItems > 0) 
                        {
                            if ($itemsremaining < 0) 
                            {
                                $itemsremaining = 0;
                            }

                            return json_encode(array('status' => '1', 'nextpagenumber' => $start, 'projectcount' => (string)$cntproject,'itemsremaining' => $itemsremaining,'projects' => $projectdetails));
                            exit;
                        }
                        else
                        {
                            return json_encode(array('status' => '1', 'message' => "There are no job available"));
                            exit;
                        }
                    }
                    else {
                        return json_encode(array('status' => '0', 'message' => "There are no job available"));
                        exit;
                    }
                
                }
                else 
                {
                    return json_encode(array('status' => '0', 'message' => "There are no job available"));
                    exit;
                }
            }
            
        
    }
   
    /*Name : In progess projects
    Url  :http://103.51.153.235/project_management/public/index.php/api/inProgessProject?
    userid=182&privatekey=1SQTsAHCnM5UWB87
    Date : 14-09-18
    By   : Suvarna*/
    public function inProgessProject(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            $errorMsg = array('status' => '0', 'message' => "Mandatory Parameter is missing");
            
            return json_encode($errorMsg);
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $usertype = $user->user_types_id;
        if($usertype == 1)
        {
            $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('projects.user_id','=',$userid)
                        ->groupBy('projects.project_id')
                        ->havingRaw('COUNT(project_status_type_id) =3')
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();
                       
            $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
            $totalRemaingItems = $count[0]->Totalcount - $items;
            $count = $projects->count();
            $cntprojects = 0;
            $totalprojects = 0;
                   
            if($count != 0)
            {
                foreach($projects as $value)
                {
                    $projectid = $value->project_id;
                    $onholdstatus = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',6)->first();
                    if(isset($onholdstatus))
                    {
                        $flag = '1';
                        $message = 'On Hold';

                    }
                    else
                    {
                        $flag = '0';
                        $message = 'In Progress';
                    }
                    $inprogressproject = Project::where('project_id','=',$projectid)->first();

                    $scope = $inprogressproject->scope_performed_id;
                    $data = $this->getscopeperformed($scope);
                    if(isset($inprogressproject->on_site_date))
                    {
                        $onsitedate = (string)$inprogressproject->on_site_date;
                        $datetime2 = new DateTime($onsitedate);
                        $onsitedate= $datetime2->format("Y-m-d");
                    }
                    else
                    {
                        $onsitedate = '';
                    }
                    $reportduedate = $inprogressproject->report_due_date;
                    $datetime2 = new DateTime($reportduedate);
                    $reportduedate = $datetime2->format("Y-m-d");
                    $created_at = (String)$inprogressproject->created_at;
                    $datetime2 = new DateTime($created_at);
                    $created_at = $datetime2->format("Y-m-d");
                    $associate = ProjectBid::where('project_id','=',$projectid)
                                     ->where('project_bid_status','=',1)->first();

                    $associatebid = number_format($associate->associate_suggested_bid, 2);
                    $approxbid = number_format($project->approx_bid, 2);
                    $progressproject[] = ['projectid' => (string)$projectid, 
                                'projectname' =>  $inprogressproject->project_name, 
                                'siteaddress' => $inprogressproject->project_site_address,
                                'createddate'  => $created_at,
                                'onsitedate' => $onsitedate,
                                'reportduedate' => $reportduedate,
                                'template' => $inprogressproject->report_template,
                                'instructions' => $inprogressproject->instructions,
                                'suggestedbid' =>(String)$approxbid,
                                'associatebid' => (string)$associatebid,
                                'scopeperformed' => $data,
                                'onholdflag'  => $flag,
                                'projectstatus'   => $message
                                ];
                    $cntprojects += 1;

                        
                }
                if (!empty($projects)) 
                {
                    $itemsremaining = $totalRemaingItems - $limit;
                    if ($totalRemaingItems > 0) 
                    {
                        if ($itemsremaining < 0)
                        {
                            $itemsremaining = 0;
                        }
                  
                        $successMsg = array('status' => '1', 'nextpagenumber' => $start, 'projectcount' => (string)$cntprojects,'itemsremaining' => $itemsremaining,'inprogressproject' => $progressproject);
                       
                        return json_encode($successMsg);
                        exit;
                    }
                    else 
                    {
                        $errorMsg = array('status' => '1', 'message' => "There are no jobs available");
                       
                        return json_encode($errorMsg);
                        exit;
                    }
                }
                else 
                {
                    $errorMsg = array('status' => '0', 'message' => "There are no jobs available");
                    
                    return json_encode($errorMsg);
                    exit;
                }
            }
            else
            {
                $errorMsg = array('status' => '0', 'message' => "There are no jobs available");
                return json_encode($errorMsg);
                exit;
            }
                   
                
        }
        else
        {
            $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('project_bids', 'project_bids.project_id', '=', 'project_status.project_id')
                        ->where('project_bids.user_id','=',$userid)
                        ->where('project_bids.project_bid_status','=',1)
                        ->groupBy('project_status.project_id')
                        ->havingRaw('COUNT(project_status_type_id) = 3')
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();
            $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
            $totalRemaingItems = $count[0]->Totalcount - $items;
            $count = $projects->count();
            $cntprojects = 0;
            $totalprojects = 0;
            if($count != 0)
            {
                foreach($projects as $value)
                {
                    $projectid = $value->project_id;
                    $onholdstatus = ProjectStatus::where('project_id','=',$projectid)
                                ->where('project_status_type_id','=',6)->first();
                    if(isset($onholdstatus))
                    {
                        $flag = '1';
                        $message = 'On Hold';
                    }
                    else
                    {
                        $flag = '0';
                        $message = 'In Progress';
                    }
                    $inprogressproject = Project::where('project_id','=',$value->project_id)->first();
                    $scope = $inprogressproject->scope_performed_id;
                    $data = $this->getscopeperformed($scope);
                    if(isset($inprogressproject->on_site_date))
                    {
                        $onsitedate = (string)$inprogressproject->on_site_date;
                        $datetime2 = new DateTime($onsitedate);
                        $onsitedate= $datetime2->format("Y-m-d");
                    }
                    else
                    {
                        $onsitedate = '';
                    }
                    $reportduedate = $inprogressproject['report_due_date'];
                    $datetime2 = new DateTime($reportduedate);
                    $reportduedate= $datetime2->format("Y-m-d");
                    $created_at = (String)$inprogressproject->created_at;
                    $datetime2 = new DateTime($created_at);
                    $created_at= $datetime2->format("Y-m-d");
                    $associate = ProjectBid::where('project_id','=',$projectid)
                                     ->where('project_bid_status','=',1)->first();
                    $associatebid = number_format($associate->associate_suggested_bid, 2);
                    $approxbid = number_format($inprogressproject->approx_bid, 2);
                    $progressproject[] = ['projectid' => (string)$projectid, 
                                    'projectname'   =>  $inprogressproject->project_name, 
                                    'siteaddress'   => $inprogressproject->project_site_address,
                                    'createddate'   => $created_at,
                                    'onsitedate'    => $onsitedate,
                                    'reportduedate' => $reportduedate,
                                    'template'      => $inprogressproject->report_template,
                                    'instructions'  => $inprogressproject->instructions,
                                    'suggestedbid'  =>(String)$approxbid,
                                    'associatebid'  => (string)$associatebid,
                                    'scopeperformed'=> $data,
                                    'onholdflag'    => $flag,
                                    'projectstatus' => $message
                                ];
                    $cntprojects += 1;
                }
                if (!empty($projects)) 
                {
                    $itemsremaining = $totalRemaingItems - $limit;
                    if ($totalRemaingItems > 0) 
                    {
                        if ($itemsremaining < 0) 
                        {
                            $itemsremaining = 0;
                        }
                  
                        $successMsg =  array('status' => '1', 'nextpagenumber' => $start, 'projectcount' => (string)$cntprojects,'itemsremaining' => $itemsremaining,'inprogressproject' => $progressproject);
                        
                        return json_encode($successMsg);
                        exit;
                    }
                    else 
                    {
                        $errorMsg =  array('status' => '1', 'message' => "There are no jobs available");
                        
                        return json_encode($errorMsg);
                        exit;
                    }
                }
                else 
                {
                    $errorMsg =  array('status' => '0', 'message' => "There are no jobs available");
                    
                    return json_encode($errorMsg);
                    exit;
                }
            }
            else
            {
                $errorMsg =  array('status' => '0', 'message' => "There are no jobs available");
                
                return json_encode($errorMsg);
                exit;
            }
        }
    }
    /*Name : view user profile for project history 
    Url  :http://103.51.153.235/project_management/public/index.php/api/viewProfile?userid=182&privatekey=10l4SesaKyxue87i&projectid=1
    Date : 07-09-18
    By   : Suvarna*/
    public function viewProfile(Request $request)
    {
        $user =$this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $usertypeid = $user->user_types_id;
        if($usertypeid == 1)
        {
            $projectid = $request['projectid'];
            $projectbid = ProjectBid::where('project_id','=',$projectid)
                                    ->where('project_bid_status','=',1)->first();
            $associateid = $projectbid->user_id;
            $associate = User::where('users_id','=',$associateid)->first();
            $username = $associate->users_name;
            $lastname = $associate->last_name;
            if($lastname == null)
            {
                $lastname = '';
            }
            else
            {
                $username = $username.' '.$lastname;
            }
            $usertype = $associate->user_types_id;
            $company =$associate->users_company;
            $phone = $associate->users_phone;
            $email = $associate->users_email;
            $profileimage = asset("/img/users/" . $associate['users_profile_image']);
            $projectcount = ProjectBid::where('user_id','=',$associateid)
                                        ->where('project_bid_status','=',1)->count();
            $bidmadecount = ProjectBid::where('project_bid_status','<>',0)
                                                ->where('bid_status','=',1)
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
                                   where('project_bid_status','=',1)
                                   ->get();
            if(count($projectbid) > 0)
            {
                foreach ($projectbid as $value) 
                {
                    $projectid = $value->project_id;
                    $project = Project::where('project_id','=',$projectid)->
                            first();
                    $reportduedate = $project->report_due_date;
                    $reportduedate = new DateTime($reportduedate);
                    $reportduedate= $reportduedate->format("Y-m-d");
                    $projectstatus = ProjectStatus::where('project_id','=',$projectid)->get();
                    foreach ($projectstatus as  $status) 
                    {
                        $currentstatus = $status->project_status_type_id;
                    }

                    if($currentstatus == 3 || $currentstatus == 6)
                    {
                        $todaydate = date('Y-m-d');
                                
                        if($todaydate > $reportduedate)
                        {
                            $overdueprojectcount = $overdueprojectcount + 1;
                        }
                                
                    }

                }
            }
            $review = UserReview::where('to_user_id','=',$associateid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
            if(!isset($review))
            {
                $review = '0.0';
            }

            if($bidmadecount < 10)
            {
                $bidmadecount = '0'.(string)$bidmadecount;
            }
            if($completedprojectcount < 10)
            {
                $completedprojectcount = '0'.(string)$completedprojectcount;
            }
            if($overdueprojectcount < 10)
            {
                $overdueprojectcount = '0'.(string)$overdueprojectcount;
            }
            $jobscompleted = (string)$completedprojectcount;
            $totalbidcount = (string)$bidmadecount;
            $overdueproject = (string)$overdueprojectcount;
            $rating = (string)$review;
            $myprofile =array($jobscompleted,$totalbidcount,$overdueproject,$rating);
            $temp = array('status'                 => '1',
                                    'userid'                => (string)$associateid,
                                    'username'              => $username,
                                    'profileimage'          => $profileimage,
                                    'usertype'              =>(string)$usertype,
                                    'company'               => $company,
                                    'phone'                 => $phone,
                                    'email'                 => $email,
                                    'bidmadecount'          => (string)$bidmadecount,
                                    'completedprojectcount' => (string)$completedprojectcount,
                                    'overdueprojectcount'   =>(string)$overdueprojectcount,
                                    'review'                => (string)$review,
                                    'myprofile'             => $myprofile);
            
            return json_encode($temp);
            exit;
        }
        else
        {
            $projectid = $request['projectid'];
            $scheduler = Project::where('project_id','=',$projectid)->first();
            $schedulerid = $scheduler->user_id;
            $scheduler = User::where('users_id','=',$schedulerid)->first();
            $username = $scheduler->users_name;
            $lastname = $scheduler->last_name;
            if(!isset($lastname))
            {
                $lastname = '';
            }
            else
            {
                $username = $username.' '.$lastname;
            }
            $usertype = $scheduler->user_types_id;
            $company = $scheduler->users_company;
            $phone = $scheduler->users_phone;
            $email = $scheduler->users_email;
            $profileimage = asset("/img/users/" . $scheduler['users_profile_image']);
            $bidmadecount = DB::table('projects')
                                ->leftJoin('project_bids', 'projects.project_id', '=', 'project_bids.project_id')
                                ->where('projects.user_id','=',$schedulerid)
                                ->where('project_bid_status','=',1)->count();
            $completedprojectcount = DB::table('projects')
                                    ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                                    ->where('projects.user_id','=',$schedulerid)
                                    ->where('project_status.project_status_type_id','=',4)->count();
            $overdueprojectcount = 0;
            $project = Project::where('user_id','=',$schedulerid)->get();
            foreach ($project as $value) 
            {
                $projectid = $value->project_id;
                $reportduedate = $value->report_due_date;
                $reportduedate = new DateTime($reportduedate);
                $reportduedate= $reportduedate->format("Y-m-d");
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                 ->get();
                foreach ($projectstatus as  $status) 
                {
                    $currentstatus = $status->project_status_type_id;
                }

                if($currentstatus == 3 || $currentstatus == 6)
                {
                    $todaydate = date('Y-m-d');
                            
                    if($todaydate > $reportduedate)
                    {
                        $overdueprojectcount = $overdueprojectcount + 1;
                    }
                                
                }

            }
        }
        $review = UserReview::where('to_user_id','=',$schedulerid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
        if(!isset($review))
        {
            $review = '0.0';
        }

        if($bidmadecount < 10)
        {
            $bidmadecount = '0'.(string)$bidmadecount;
        }
        if($completedprojectcount < 10)
        {
            $completedprojectcount = '0'.(string)$completedprojectcount;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        $jobscompleted = (string)$completedprojectcount;
        $totalbidcount = (string)$bidmadecount;
        $overdueproject = (string)$overdueprojectcount;
        $rating = (string)$review;
        $myprofile = array($jobscompleted,$totalbidcount,$overdueproject,$rating);
        $temp = array('status'                 => '1',
                                'userid'                => (string)$schedulerid,
                                'username'              => $username,
                                'profileimage'          => $profileimage,
                                'usertype'              => (string)$usertype,
                                'company'               => $company,
                                'phone'                 => (string)$phone,
                                'email'                 => $email,
                                'bidmadecount'          => (string)$bidmadecount,
                                'completedprojectcount' => (string)$completedprojectcount,
                                'overdueprojectcount'   => (string)$overdueprojectcount,
                                'review'                => (string)$review,
                                'myprofile'             => $myprofile);
        
        return json_encode($temp);
        exit;
   
    }
    /*Name : view user review
    Url  :http://103.51.153.235/project_management/public/index.php/api/viewUserReview?userid=182&privatekey=10l4SesaKyxue87i&reviewuserid=181
    Date : 07-09-18
    By   : Suvarna*/
    public function viewUserReview(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        /* limit and pagenumber for pagination */
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $userid = $request['userid'];
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];  
        $reviewuserid = $request['reviewuserid']; 
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $review = DB::table('user_reviews')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS user_review_id'),
                             'user_review_id', 'from_user_id','user_review_comments','created_at','user_review_ratings'
                           )
                            ->where('to_user_id','=',$reviewuserid)
                            ->where('user_review_status','=',1)
                            ->orderBy('user_review_id', 'desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $review->count();
        $cntreviews = 0;
        $totalreview = 0;
        if($count != 0) 
        {
            foreach ($review as $value)
            {
                    $byuserid = $value->from_user_id;
                    $model = User::where('users_id','=',$byuserid)->first();
                    $lastname = $model->last_name;
                    $username = $model->users_name.' '.$lastname;
                    $profileimage = asset("/img/users/" . $model['users_profile_image']);
                    $commentdate = $value->created_at;
                    $commentdate = new DateTime($commentdate);
                    $commentdate = $commentdate->format("jS F Y h:i s");
                    $userreview[] = ['profileimage' => $profileimage, 'username' =>  $username, 'rating' => (string)$value->user_review_ratings,
                        'comment' => $value->user_review_comments,
                        'commentdate' => $commentdate];
                    $cntreviews += 1;
            }
            if(isset($review)) 
            {
                $itemsremaining = $totalRemaingItems - $limit;
                if ($totalRemaingItems > 0) 
                {
                    if ($itemsremaining < 0) 
                    {
                        $itemsremaining = 0;
                    }
                }
            }
            if(isset($userreview))
            {
                echo json_encode(array('status' => '1', 'nextpagenumber' => $start, 'reviewcount' => (string)$cntreviews,'itemsremaining' => $itemsremaining,'userreview' => $userreview));
                exit;
            }
            else
            {
                echo json_encode(array('status' => '1', 'message' => "There are no review available for user"));
                exit;
            }
                   
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "No any review for this user"));
            exit;
        }
    }
    /*Name : Update Project
    Url  :http://103.51.153.235/project_management/public/index.php/api/updateProject?userid=182&privatekey=10l4SesaKyxue87i&projectid=5&template=Quire1
    Date : 07-09-18
    By   : Suvarna*/
    /*public function updateProject(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
                $projectid = $request['projectid'];
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
                if(isset($request['onsitedate']))
                {
                    $onsitedate = new DateTime($request['onsitedate']);
                    $projectid = $request['projectid'];
                    $model  = Project::where('project_id', '=',$projectid)
                    ->update(['on_site_date' => $onsitedate]);
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
                $projects = Project::where('project_id','=',$projectid)->first();
                $latitude = (double)$request['latitude'];
                $longitude = (double)$request['longitude'];
                $miles = (int)$request['miles'];
                $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                        FROM users
                        WHERE  user_types_id <>1
                        HAVING distance <= $miles"));
               
              
                    foreach($result as $value) 
                    {
                        
                        $date = date('Y-m-d H:i:s');
                        $update = ProjectNotification::where('to_user_id', '=', $value->users_id)
                            ->where('project_id','=',$projectid)
                            ->update(['project_notification_type_id' => 6,
                                       'created_at' => $date,
                                       'notification_text'=> 'Project manager updated project details',
                                        'read_flag' => 0]);

                        if($update == 0)
                        {
                            $model = new ProjectNotification;
                            $model->to_user_id = $value->users_id;
                            $model->from_user_id = $userid;
                            $model->project_id = $projectid;
                            $model->notification_text = 'Project manager updated project details';
                            $model->project_notification_type_id = 6;
                            $model->created_at = date('Y-m-d H:i:s');
                            $model->save();
                            $bidrequest = new ProjectBidRequest();
                            $bidrequest->project_id = $projectid;
                            $bidrequest->to_user_id = $value->users_id;
                            $bidrequest->from_user_id = $userid;
                            $bidrequest->created_at = date('Y-m-d H:i:s');
                            $bidrequest->save();
                        }
                        $accesskey = UserAccessKey::where('user_id','=',$value->users_id)->where('user_access_key_status','=',1)->get();
                        $notification = ProjectNotification::where('project_id','=',$projectid)->where('from_user_id','=',$userid)
                        ->where('to_user_id','=',$value->users_id)
                        ->where('project_notification_type_id','=',6)->first();
                        $sentnotificationid = $notification->project_notification_id;
                        $notificationcount = ProjectNotification::where('to_user_id','=',$value->users_id)->where('read_flag','=',0)->count();
                        $notificationcount = (string)$notificationcount;
                       foreach($accesskey as  $key) 
                       {
                           $device = UserDevice::where('user_device_id','=',$key->user_device_id)->first();
                           $body = $request['projectname'];
                           $title = 'Project manager updated project details';
                           $devicetokenid = $device->user_device_unique_id;
                           $devicetype = $device->user_device_type;
                           $notificationid = '6';
                           $model = new ProjectNotificationSentDevice;
                           $model->project_notification_id = $sentnotificationid;
                           $model->user_device_id = $device->user_device_id;
                           $model->notification_sent = date('Y-m-d H:i:s');
                           $model->save();
                           $notificationstatus = User::where('users_id','=',$value->users_id)
                                                ->where('notification_enable','=',1)->first();
                           if(isset($notificationstatus))
                           {
                                $projectid = (string)$projectid;
                           
                                $this->pushnotification($devicetokenid,$title,$body,$notificationid,$projectid,$notificationcount,$devicetype);

                           }
                           
                            
                        }
                    }
                echo json_encode(array('status' => '1', 'message' => "Project updated successfully"));
                exit;
            
    }*/
    /*Name : Project Inprogress Status
    Url  :http://103.51.153.235/project_management/public/index.php/api/inprogressStatus?userid=182&privatekey=10l4SesaKyxue87i&projectid=1
    Date : 14-09-18
    By   : Suvarna*/
    public function inprogressStatus(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        /* limit and pagenumber for pagination */
        if(!isset($request['limit']) || !isset($request['pagenumber']) && $request['projectid']) 
        {
            $errorMsg = array('status' => '0', 'message' => "Mandatory Parameter is missing.");
            
            return json_encode($errorMsg);
            exit;
        }
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $progress = DB::table('project_progress_status')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_progress_status_id'),
                             'project_id','project_progress_status_subject','project_progress_status','created_at'
                           )
                            ->where('project_id','=',$projectid)
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $progress->count();
        $cntstatus = 0;
        $totalstatus = 0;
        if($count != 0) 
        {
            foreach($progress as $value) 
            {
                $subject = $value->project_progress_status_subject;
                $status = $value->project_progress_status;
                $date=$value->created_at;
                $datetime2 = new DateTime($date);
                $createddate = $datetime2->format("jS F Y, h:i:s");
                $progressstatus[] = ['subject' => $subject, 'status' =>  $status, 'createddate' => (string)$createddate];
                $cntstatus += 1;
            }
            if(!empty($progress)) 
            {
                $itemsremaining = $totalRemaingItems - $limit;
                if($totalRemaingItems > 0) 
                {
                    if($itemsremaining < 0) 
                    {
                        $itemsremaining = 0;
                    }
                    $successMsg =  array('status' => '1', 'nextpagenumber' => $start, 'statuscount' => (string)$cntstatus,'itemsremaining' => $itemsremaining,'progressstatus' => $progressstatus);
                    
                    return json_encode($successMsg);
                    exit;
                }
                else 
                {
                    $errorMsg =  array('status' => '1', 'message' => "There are no status available");
                    
                    return json_encode($errorMsg);
                    exit;
                }
            }
        }
        else
        {
            $errorMsg = array('status' => '0', 'message' => "No any status for this Job");
            
            return json_encode($errorMsg);
            exit;
        }
    }
    /*Name : Store User reviews
    Url  :http://103.51.153.235/project_management/public/index.php/api/storeuserReview?userid=182&privatekey=10l4SesaKyxue87i&projectid=1&ratings=4.5&comment=good
    Date : 14-09-18
    By   : Suvarna*/
    public function storeuserReview(Request $request)
    {
        if(isset($request['userid']) && isset($request['privatekey']) && isset($request['projectid']))
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
                    $text = 'New Rating given by Manager!';
                }
                else
                {
                    $project = Project::where('project_id','=',$projectid)->first();
                    $touserid = $project->user_id;
                    $text = 'New Rating given by Associate!';
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
                    $notificationid = '11';
                    $project = Project::where('project_id','=',$projectid)->first();
                    $body = $project->project_name;
                    $title = $text;
                    $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
           
                
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
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $bids = DB::table('project_bids')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_bid_id'),
                             'project_id', 'user_id','project_bid_status','created_at','associate_suggested_bid')
                            ->where('project_id','=',$projectid)
                            ->where('project_bid_status','=',2)
                            ->where('bid_status','=',1)
                            ->orderBy('project_bid_id', 'desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $bids->count();
        $cntbids = 0;
        $totalbids = 0;
                
        if ($count != 0) 
        {
            foreach($bids as $value) 
            {
                $projectid = $value->project_id;
                $projects = Project::where('project_id','=',$projectid)->first();
                $projectname = $projects->project_name;
                $suggestedbid = number_format($projects->approx_bid, 2);
                $associateid = number_format($value->user_id, 2);
                $associate = User::where('users_id','=',$associateid)->first();
                $projectbids[] = ['associatename' => $associate->users_name, 
                                  'associatebid'  =>  (string)$value->associate_suggested_bid,
                                  'associateid'   => (string)$associateid,
                                  'projectname'   => $projectname,
                                  'suggestedbid'  => (string)$suggestedbid];
                $cntbids += 1;
            }
            if(!empty($bids)) 
            {
                $itemsremaining = $totalRemaingItems - $limit;
                if($totalRemaingItems > 0) 
                {
                    if ($itemsremaining < 0) 
                    {
                        $itemsremaining = 0;
                    }
                  
                    echo json_encode(array('status' => '1', 'nextpagenumber' => $start, 'bidscount' => (string)$cntbids,'itemsremaining' => $itemsremaining,'projectbids' => $projectbids));
                    exit;
                }
                else 
                {
                    echo json_encode(array('status' => '1', 'message' => "There are no bids available"));
                    exit;
                }
            }
                
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "No any bids for this job"));
            exit;
        }
            
    }
    /*Name : Add project status
    Url  :http://103.51.153.235/project_management/public/index.php/api/addStatus?userid=181&privatekey=WOIBYa5i66feh8N1&projectid=17&subject=level4&status=xyz
    Date : 14-09-18
    By   : Suvarna*/
    public function addStatus(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
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
        $scheduler = Project::where('project_id','=',$projectid)
                              ->first();
        $touserid = $scheduler->user_id;
        $text = 'Associate added new status!';
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $title = $text;
        $notificationid = '12';
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
                
        return json_encode(array('status' => '1', 'message' => "Status added successfully"));
        exit;
            
    }
    /*Name : associate bids
    Url  :http://103.51.153.235/project_management/public/index.php/api/myBids?%20userid=181&privatekey=WOIBYa5i66feh8N1
    Date : 14-09-18
    By   : Suvarna*/
    public function myBids(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
        $bids = DB::table('project_bids')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_bid_id'),
                             'project_id', 'user_id','project_bid_status','created_at','associate_suggested_bid')
                            ->where('user_id','=',$userid)
                            ->where('project_bid_status','<>',1)
                            ->where('bid_status','=',1)
                            ->orderBy('project_bid_id', 'desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();

        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $bids->count();
        $cntbids = 0;
        $totalbids = 0;
        if($count != 0) 
        {
            foreach($bids as $value) 
            {
                $projectid = $value->project_id;
                $projectapprove = ProjectBid::where('project_id','=',$projectid)
                                        ->where('project_bid_status','=',1)->first();
                if(isset($projectapprove))
                {
                    $projectstatus = '1';
                }
                else
                {
                    $projectstatus = '0';
                }
                $project = Project::where('project_id','=',$projectid)->first();
                $projectname = $project->project_name;
                $siteaddress = $project->project_site_address;
                if($value->project_bid_status == 1)
                {
                    $bidstatus = "Bid Accepted";
                }
                elseif($value->project_bid_status == 0)
                {
                    $bidstatus = "Bid Rejected";
                }
                else
                {
                    $bidstatus = "Awaiting Response";
                }
                $bid = number_format($value->associate_suggested_bid, 2);
               
                $mybids[] = ['projectid' => (string)$projectid, 
                            'projectname' => $projectname,
                            'siteaddress' => $siteaddress,
                            'yourbid' => (string)$bid, 
                            'bidstatus' => $bidstatus,
                            'bidstatusflag' => (string)$value->project_bid_status,
                            'projectallocatedstatus' => $projectstatus];
                $cntbids += 1;
            }

            if ($count != 0) 
            {
                $itemsremaining = $totalRemaingItems - $limit;
                if ($totalRemaingItems > 0) 
                {
                    if ($itemsremaining < 0) 
                    {
                        $itemsremaining = 0;
                    }
                    echo json_encode(array('status' => '1', 'nextpagenumber' => $start, 'bidscount' => (string)$cntbids,'itemsremaining' => $itemsremaining,'mybids' => $mybids));
                    exit;
                }
                else 
                {
                    echo json_encode(array('status' => '1', 'message' => "There are no bids available"));
                    exit;
                }
            }
                
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "There are no bids available"));
            exit;   
        }
    }
    /*Name : bid request
    Url  :http://103.51.153.235/project_management/public/index.php/api/bidRequest?userid=181&privatekey=eVpUnLCUoGRPDvT2&projectid=14&bidvalue=5000
    Date : 15-09-18
    By   : Suvarna*/
    public function bidrequest(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(isset($request['bidvalue']))
        {
            if($request['bidvalue'] < 1)
            {
                $temp = array('status' => '0', 'message' => "Please enter bid value is greater than 0");
                return json_encode($temp);
                exit; 
            }
            $bidamount = $request['bidvalue'];
            $projectid = $request['projectid'];
            $userid = $request['userid'];
            $bidUser = ProjectBid::where('project_id','=',$projectid)
                                  ->where('user_id','=',$userid)
                                  ->where('project_bid_status','=',2)
                                  ->where('bid_status','=',1)->first();
            if(isset($bidUser))
            {
                $projectbid = ProjectBid::where('project_id','=',$projectid)
                                    ->where('user_id','=',$userid)
                                    ->where('project_bid_status','=',2)
                                    ->update(['associate_suggested_bid' => $bidamount,'created_at' => date('Y-m-d H:i:s')]);
            }
            else
            {
                $bid = new ProjectBid;
                $bid->project_id = $projectid;
                $bid->user_id = $userid;
                $bid->associate_suggested_bid = $bidamount;
                $bid->created_at = date('Y-m-d H:i:s');
                $bid->bid_status = 1;
                $bid->save();
            }
            $temp = array('status' => '1', 'message' => "bid request applied successfully");
            return json_encode($temp);
            exit;
        }
        else
        {
            $temp = array('status' => '0', 'message' => "Mandatory field is required");
           
            return json_encode($temp);
            exit;  
        }
            
    }
    /*Name : complete project by Scheduler
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectComplete?%20userid=182&privatekey=U5Z5Y9PLqrR1zm9B&projectid=24
    Date : 15-09-18
    By   : Suvarna*/
    public function projectComplete(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 4;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $touserid = $associate->user_id;
        $text = 'Project completed by manager!';
        $notificationid = '7';
        $title = $text;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
        echo json_encode(array('status' => '1', 'message' => "Job completed successfully"));
        exit;                                         
           
    }
    /*Name : cancel project by Scheduler
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectCancel?%20userid=182&privatekey=U5Z5Y9PLqrR1zm9B&projectid=24
    Date : 15-09-18
    By   : Suvarna*/
    public function projectCancel(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 5;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $touserid = $associate->user_id;
        $text = 'Project cancelled by manager!';
        $notificationid = '8';
        $title = $text;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
        echo json_encode(array('status' => '1', 'message' => "Job cancelled successfully"));
        exit;                                         
            
    }
    /*Name : associate profile for in publish project
    Url  :http://103.51.153.235/project_management/public/index.php/api/associateProfile?userid=182&privatekey=10l4SesaKyxue87i&associateid=181
    Date : 18-09-18
    By   : Suvarna*/
    public function associateProfile(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
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
                    
        $bidmadecount = ProjectBid::where('project_bid_status','<>',0)
                    ->where('bid_status','=',1)
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
                $reportduedate = new DateTime($reportduedate);
                $reportduedate= $reportduedate->format("Y-m-d");
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                 ->get();
                foreach ($projectstatus as  $status) 
                {
                    $currentstatus = $status->project_status_type_id;
                }

                if($currentstatus == 3 || $currentstatus == 6)
                {
                    $todaydate = date('Y-m-d');
                                
                    if($todaydate > $reportduedate)
                    {
                        $overdueprojectcount = $overdueprojectcount + 1;
                    }
                                
                }

            }
        }

        $review = UserReview::where('to_user_id','=',$associateid)->
                    where('user_review_status','=',1)->max('user_review_ratings');
        if(!isset($review))
        {
            $review = '0.0';
        }

        if($bidmadecount < 10)
        {
            $bidmadecount = '0'.(string)$bidmadecount;
        }
        if($completedprojectcount < 10)
        {
            $completedprojectcount = '0'.(string)$completedprojectcount;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        $jobscompleted = (string)$completedprojectcount;
        $totalbidcount = (string)$bidmadecount;
        $overdueproject = (string)$overdueprojectcount;
        $rating = (string)$review;
        $myprofile = array($jobscompleted,$totalbidcount,$overdueproject,$rating);
        echo json_encode(array('status'                 => '1',
                                'userid'                => (string)$associateid,
                                'username'              => $username,
                                'profileimage'          => $profileimage,
                                'usertype'              =>(string)$usertype,
                                'bidmadecount'          => (string)$bidmadecount,
                                'completedprojectcount' => (string)$completedprojectcount,
                                'overdueprojectcount'   =>(string)$overdueprojectcount,
                                'review'                => (string)$review,
                                'myprofile'             => $myprofile));

        exit;
            
    }
    /*Name : Available Projects for associate
    Url  :http://103.51.153.235/project_management/public/index.php/api/availableProject?%20userid=181&privatekey=U5Z5Y9PLqrR1zm9B
    Date : 18-09-18
    By   : Suvarna*/
    public function availableProject(Request $request,$searchKeyword = "")
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            $errorMsg = array('status' => '0', 'message' => "Mandatory Parameter is missing.");
            
            return json_encode($errorMsg);
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);
         $where_condition = "1 = 1";
        if($searchKeyword != "") {
            $where_condition = "  (project_name Like  '%$searchKeyword%')";
            $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('project_bid_request', 'project_bid_request.project_id', '=', 'project_status.project_id')
                        ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('project_bid_request.to_user_id','=',$userid)
                        ->whereRaw($where_condition)
                        ->groupBy('project_status.project_id')
                        ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                        ->orderBy('project_bid_request.project_bid_request_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();
                
        }
        else{
            $projects = DB::table('project_status')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                            ->leftJoin('project_bid_request', 'project_bid_request.project_id', '=', 'project_status.project_id')
                            ->where('project_bid_request.to_user_id','=',$userid)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('project_bid_request.project_bid_request_id', 'desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        }
       /* $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('project_bid_request', 'project_bid_request.project_id', '=', 'project_status.project_id')
                        ->where('project_bid_request.to_user_id','=',$userid)
                        ->groupBy('project_status.project_id')
                        ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                        ->orderBy('project_bid_request.project_bid_request_id', 'desc')
                        ->limit($limit)
                        ->offset($items)
                        ->get();*/
        
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $projects->count();
        $cntprojects = 0;
        $totalprojects = 0;
        if($count != 0)
        {
            foreach($projects as $value)
            {
                $projectid = $value->project_id;
                $publishproject = Project::where('project_id','=',$value->project_id)->first();
                $scope = $publishproject->scope_performed_id;
                $data = $this->getscopeperformed($scope);
                if(isset($publishproject->on_site_date))
                {
                    $onsitedate = (string)$publishproject->on_site_date;
                    $datetime2 = new DateTime($onsitedate);
                    $onsitedate= $datetime2->format("Y-m-d");
                }
                else
                {
                    $onsitedate = '';
                }
                $reportduedate = $publishproject['report_due_date'];
                $datetime2 = new DateTime($reportduedate);
                $reportduedate= $datetime2->format("Y-m-d");
                $created_at = (String)$publishproject->created_at;
                $datetime2 = new DateTime($created_at);
                $created_at= $datetime2->format("Y-m-d");
                $manager = User::where('users_id','=',$publishproject->user_id)->first();
                $profileimage = asset("/img/users/" . $manager->users_profile_image);
                $approxbid = number_format($publishproject->approx_bid, 2);
                $publishprojects[] = ['projectid' => (string)$publishproject->project_id, 
                                'projectname'     =>  $publishproject->project_name, 
                                'siteaddress'     => $publishproject->project_site_address,
                                'createddate'     => $created_at,
                                'onsitedate'      => $onsitedate,
                                'reportduedate'   => $reportduedate,
                                'template'        => $publishproject->report_template,
                                'instructions'    => $publishproject->instructions,
                                'approxbid'       =>(String)$approxbid,
                                'latitude'        =>(string)$publishproject->latitude,
                                'longitude'       =>(string)$publishproject->longitude,
                                'miles'           =>(string)$publishproject->milesrange,
                                'managerimage'    => $profileimage,
                                'scopeperformed'  => $data,
                                ];
                $cntprojects += 1;
            }
                
            if ($count != 0) 
            {
                $itemsremaining = $totalRemaingItems - $limit;
                if ($totalRemaingItems > 0) 
                {
                    if ($itemsremaining < 0) 
                    {
                        $itemsremaining = 0;
                    }
                  
                    $temp = array('status' => '1', 'nextpagenumber' => $start, 'projectcount' => (string)$cntprojects,'itemsremaining' => $itemsremaining,'publishprojects' => $publishprojects);
                    
                    return json_encode($temp);
                    exit;
                }
                else 
                {
                    $errorMsg =  array('status' => '0', 'message' => "There are no jobs available");
                   
                    return json_encode($errorMsg);
                    exit;
                }
            }
            else 
            {
                $errorMsg =  array('status' => '0', 'message' => "There are no jobs available");
               
                return json_encode($errorMsg);
                exit;
            }
        }
        else
        {
            $errorMsg =  array('status' => '0', 'message' => "There are no jobs available");
            
            return json_encode($errorMsg);
            exit;
        }
            
    }

    // this function is called when user change his address
    public function updateavailableProject($userid)
    {
        $flag = ProjectBidRequest::where('to_user_id','=',$userid)->delete();
        $projects = DB::table('project_status')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                        ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                        ->groupBy('project_status.project_id')
                        ->havingRaw('COUNT(project_status_type_id) = 1')
                        ->get();
        $count = $projects->count();
        if($count != 0)
        {
            $scope_Id = UserScopePerformed::where('users_id','=',$userid)->first();
            $userScopeId = (string)$scope_Id->scope_performed_id;
            $userScopeId = explode(",",$userScopeId);
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;
                $publishproject = Project::where('project_id','=',$projectid)->first();
                $latitude = (double)$publishproject->latitude;
                $longitude = (double)$publishproject->longitude;
                $miles = (int)$publishproject->milesrange;
                $employeetype = $publishproject->employee_type_id;
                $scope = $publishproject->scope_performed_id;
                $scope = explode(",",$scope);
                $managerid = $publishproject->user_id;
                $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                FROM users
                WHERE  users_id = $userid
                AND associate_type_id IN ($employeetype)
                HAVING distance <= $miles"));
                if(!empty($result))
                {
                    
                    
                    $scopeflag = 1;
                    //check user scope performed is matches or not
                    foreach($scope as $scopeid) {
                        if(in_array($scopeid, $userScopeId))
                        {
                            $scopeflag = 1;
                        }
                        else
                        {
                            $scopeflag = 0;
                            break;
                        } 
                    }
                    if($scopeflag == 1)
                    {
                        $bidrequest = new ProjectBidRequest();
                        $bidrequest->project_id = $projectid;
                        $bidrequest->to_user_id = $userid;
                        $bidrequest->from_user_id = $managerid;
                        $bidrequest->created_at = date('Y-m-d H:i:s');
                        $bidrequest->save();
                    }
                    
                }
            }
        }
    }
    /*Name : Available Projects for associate on mapview
    Url  :http://103.51.153.235/project_management/public/index.php/api/mapAvailableProject?%20userid=181&privatekey=U5Z5Y9PLqrR1zm9B
    Date : 15-10-18
    By   : Suvarna*/
    public function mapAvailableProject(Request $request,$searchKeyword = "")
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projects = DB::table('project_status')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_status.project_status_id'),'project_status.project_id','project_status.project_status_type_id')
                            ->leftJoin('project_bid_request', 'project_bid_request.project_id', '=', 'project_status.project_id')
                            ->where('project_bid_request.to_user_id','=',$userid)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('project_bid_request.project_bid_request_id', 'desc')
                            ->get();
       
        if(isset($projects))
        {
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;
                $publishproject = Project::where('project_id','=',$projectid)->first();
                $manager = User::where('users_id','=',$publishproject->user_id)->first();
                $profileimage = asset("/img/users/" . $manager->users_profile_image);
                $approxbid = number_format($publishproject->approx_bid, 2);
                $publishprojects[] = ['projectid' => (string)$publishproject->project_id, 
                                'projectname'     => $publishproject->project_name, 
                                'siteaddress'     => $publishproject->project_site_address,
                                'approxbid'       => (String)$approxbid,
                                'latitude'        => (string)$publishproject->latitude,
                                'longitude'       => (string)$publishproject->longitude,
                                'managerimage'    => $profileimage,
                                
                                ];
            }
        }
        if(isset($publishprojects))
        {
            return json_encode(array('status'      => '1',
                                   'publishprojects' => $publishprojects));
            exit;
        }
        else
        {
            return json_encode(array('status' => '0', 'message' => "There are no jobs available"));
             exit;
        }
    }

    
   
    /*Name : Notification list for user
    Url  :http://103.51.153.235/project_management/public/index.php/api/notificationList?userid=12&privatekey=voO2M4DvVNGHh07L
    Date : 24-09-18
    By   : Suvarna*/
    public function notificationList(Request $request)
    {

        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        if(!isset($request['limit']) || !isset($request['pagenumber'])) 
        {
            return json_encode(array('status' => '0', 'message' => "Mandatory Parameter is missing."));
            exit;
        }
        $limit = $request['limit']; 
        $pageno = $request['pagenumber'];   
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);    
        $notification = DB::table('project_notification')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS project_notification_id'), 'project_notification_id', 'project_notification_type_id','read_flag','notification_text','project_id','created_at')
                            ->where('to_user_id','=',$userid)
                            ->orderBy('created_at','desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $totalRemaingItems = $count[0]->Totalcount - $items;
        $count = $notification->count();
        $cntNotification = 0;
        $totalNotifications = 0;
        if ($count != 0) 
        {
            foreach ($notification as $value) 
            {
                $projectstatus = ProjectStatus::where('project_id','=',$value->project_id)->where('project_status_type_id','=',3)->first();
                $projectbidrequest = ProjectBidRequest::where('project_id','=',$value->project_id)
                                                        ->where('to_user_id','=',$userid)->count();
                
                if(isset($projectstatus) || $projectbidrequest == 0)
                {
                    $statusflag = '1';
                }
                else
                {
                    $statusflag = '0';
                }
                $project = Project::where('project_id','=',$value->project_id)->first();
                $created_at = $value->created_at;
                $created_at = new DateTime($created_at);
                $createddate= $created_at->format("M jS, Y");
                $data[]=['projectname'         => $project->project_name,
                            'projectid'        => (string)$project->project_id,
                            'notificationflag' => (string)$value->project_notification_type_id,
                            'readflag'         => (string)$value->read_flag,
                            'notificationid'   => (string)$value->project_notification_id,
                            'notificationtext' => (string)$value->notification_text,
                            'createddate'      => (string)$createddate,
                            'statusflag'       => $statusflag];
                $cntNotification += 1;
            }
        }
        else {
            $temp = array('status' => '0', 'message' => "There are no Notification available");
            
            return json_encode($temp);
            exit;
        }
        if(!empty($notification)) {
            $itemsremaining = $totalRemaingItems - $limit;
            if ($totalRemaingItems > 0) {
                if ($itemsremaining < 0) {
                    $itemsremaining = 0;
                }
                $temp = array('status' => '1', 'nextpagenumber' => $start, 'notificationcount' => (string)$cntNotification,'itemsremaining' => $itemsremaining,'notification' => $data);
               
                return json_encode($temp);
                exit;
            }
            else {
                return json_encode(array('status' => '1', 'message' => "There are no Notification available"));
                exit;
            }
        }
        else {
            $temp = array('status' => '0', 'message' => "There are no Notification available");
            
            return json_encode($temp);
            exit;
        }
           
    }
    /*Name : update Read flag Notification api
    Url  :http://103.51.153.235/project_management/public/index.php/api/readNotification?userid=12&privatekey=SV28q1ePmh81BGLh&notificationid=21
    Date : 24-09-18
    By   : Suvarna*/
    public function readNotification(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $notificationid = $request['notificationid'];
        $date = date('Y-m-d H:i:s');
        $flag = ProjectNotification::where('project_notification_id', '=', $notificationid)
                    ->update(['read_flag' => 1,'notification_read_at' => $date]);
        return json_encode(array('status' => '1', 
                              'message' => "read notification status updated successfully"));
        exit;
    }
    /*Name : onhold project by Project Manager
    Url  :http://103.51.153.235/project_management/public/index.php/api/projectCancel?%20userid=182&privatekey=U5Z5Y9PLqrR1zm9B&projectid=24
    Date : 15-09-18
    By   : Suvarna*/
    public function projectOnHold(Request $request)
    {
        $user = $this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $userid = $request['userid'];
        $projectid = $request['projectid'];
        $status = $request['projectstatusflag'];
        /* status 1 for onhold project and o for inprogress project*/
        if($status == 1)
        {
            $projectbid = ProjectStatus::where('project_id','=',$projectid)
                                            ->where('project_status_type_id','=',3)
                                            ->update(['project_status_type_id' => 6]);
            $notificationid = '13';
            $msg = 'Project is Onhold by manager!';
            $message = "Project Onhold successfully";
        }
        else
        {
            $projectbid = ProjectStatus::where('project_id','=',$projectid)
                                            ->where('project_status_type_id','=',6)
                                            ->update(['project_status_type_id' => 3]);
            $notificationid = '14';
            $msg = 'Project is Inprogress by manager!';
            $message = "Project Inprogress successfully";
        }
        
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $touserid = $associate->user_id;
        $text = $msg;
        $title = $text;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
        echo json_encode(array('status' => '1', 'message' => $message));
        exit;                                         
            
    }

    /* function for to check useres private key is valid or not*/
    public function checkuserprivatekey($userid,$privatekey)
    {
        if(isset($userid) && isset($privatekey))
        {
            $userid = $userid;
            $accesskey = $privatekey;
            if($accesskey == 1)
            {
                $user  = User::where('users_id', '=',$userid)->first();
                if(isset($user))
                {
                    return $user;
                }
                else
                {
                     json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                    exit;
                }

            }
            else
            {
                $user  = User::where('users_id', '=',$userid)->first();
                $key   = UserAccessKey::where('user_access_key','=',$accesskey)
                                    ->where('user_access_key_status','=',1)
                                    ->where('user_id','=',$userid)->first();
                if(isset($user) && isset($key))
                {
                    return $user;
                }
                else
                {
                    echo json_encode(array('status' => '0', 'message' => "userid or private key is incorrect"));
                    exit;
                }
            }
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Mandatory field is required"));
            exit;  
        }
    }
    public  function getscopeperformed($scope)
    {
        $data = [];
        $temp = explode(",", $scope);
        foreach ($temp as $value) 
        {
            $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')
                                            ->where('scope_status','=','1')
                                            ->where('scope_performed_id','=',(int)$value)
                                            ->first();
            $data[]=['scope_performed_id' => (string)$scopeperformed->scope_performed_id,
                    'scope_performed'     => $scopeperformed->scope_performed];
        }
        return $data;
    }
    public function sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype)
    {
        $model = new ProjectNotification;
        $model->to_user_id = $touserid;
        $model->from_user_id = $fromuserid;
        $model->project_id = $projectid;
        $model->notification_text = $notificationtext;
        $model->project_notification_type_id = $notificationtype;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $notification = ProjectNotification::where('project_id','=',$projectid)
                                            ->where('from_user_id','=',$fromuserid)
                                            ->where('to_user_id','=',$touserid)
                                            ->where('project_notification_type_id','=',$notificationtype)->first();
        $sentnotificationid = $notification->project_notification_id;
       
        /* find devices where user is login*/
        $accesskey = UserAccessKey::where('user_id','=',$touserid)
                                    ->where('user_access_key_status','=',1)->get();
        
        $projectid = (string)$projectid;
        $notificationcount = ProjectNotification::where('to_user_id','=',$touserid)
                                                ->where('read_flag','=',0)->count();
        $notificationcount = (string)$notificationcount;
        
        foreach($accesskey as  $key) 
        {
            $userdevice = UserDevice::where('user_device_id','=',$key->user_device_id)
                                    ->first();

            $devicetokenid = $userdevice->user_device_unique_id;
            $devicetype = $userdevice->user_device_type;
            $notificationid = (string)$notificationtype;
            $model = new ProjectNotificationSentDevice;
            $model->project_notification_id = $sentnotificationid;
            $model->user_device_id = $userdevice->user_device_id;
            $model->notification_sent = date('Y-m-d H:i:s');
            $model->save();
            $user = User::where('users_id','=',$touserid)->first();
            if($user->notification_enable == 1)
            {
                $this->pushnotification($devicetokenid,$title,$body,$notificationid,$projectid,$notificationcount,$devicetype);
            }
            
        }
    }
    public function pushnotification($deviceid,$title,$body,$notificationid,$dataid,$notificationcount,$devicetype)
    {
        if($devicetype == 2)
        {

            $feedback = PushNotification::setService('fcm')
                    ->setMessage([
                                'data' => [
                                'title'              => $title,
                                'body'               => $body,
                                'notificationid'     => $notificationid,
                                'dataid'             => $dataid,
                                'notificationcount'  => $notificationcount
                                            ]
                                ])
                    ->setApiKey('AAAANdKrzEQ:APA91bHZB_ZC2PomiZ2zjIfcDRF219E7hT29sMX1X9Bi3kCNDfHEY-PZ0vlih6O4_trRs_iUUwOh-edlDGKAjSQYEM74wLhq88bLPLzra6jiRvHvSd_EWsBNza86YnmLoP1Db-hBCrtN')
                    ->setDevicesToken([$deviceid])
                    ->send()
                    ->getFeedback();
          
                  
        }
        if($devicetype == 1)
        {
            $feedback = PushNotification::setService('fcm')
                    ->setMessage([
                                'notification' => [
                                'title'              => $title,
                                'body'               => $body,
                                'notificationid'     => $notificationid,
                                'dataid'             => $dataid,
                                'notificationcount'  => $notificationcount
                                            ]
                                ])
                    ->setApiKey('AAAANdKrzEQ:APA91bHZB_ZC2PomiZ2zjIfcDRF219E7hT29sMX1X9Bi3kCNDfHEY-PZ0vlih6O4_trRs_iUUwOh-edlDGKAjSQYEM74wLhq88bLPLzra6jiRvHvSd_EWsBNza86YnmLoP1Db-hBCrtN')
                    ->setDevicesToken([$deviceid])
                    ->send()
                    ->getFeedback();
                  
        }
        

    }
    public function webpushnotification()
    {
       
            $feedback = PushNotification::setService('fcm')
                    ->setMessage([
                                'notification' => [
                                'title'              => "This is Title",
                                'body'               => "This is Message",
                                'icon'               => asset("/images/logo-icon.jpg")
                                            ]
                                ])
                    ->setApiKey('AAAA1XC4TOY:APA91bFz5hGNBaAmj9kFuaWP5LDA7CP5k4wqwka2WxSXYl1gBMF2U8DXEXdnZvie_JQ5kRU8HZE7k3d5VtbZxFgPP-yKcPp_kaYJTEwV-WwzMz7ak3pbo-aQsTabMLFUi5WGuMCq9U16')
                    ->setDevicesToken(['fxYXSiGopQM:APA91bF8VO03yQLuiEp7QHLmpUXlOvsRHahQMBGxlM6ezKG8-Ahv4Gqd74SKYz661mrEG4mRQL5e2sWliQBz2qDmVne_0-zW4aJOKiHSt8lewcnWC5clJd1Xzyqn7kEgtEJilQZ0U9sJ'])
                    ->send()
                    ->getFeedback();

          
                echo json_encode(array('status' => '0', 'message' => $feedback));
                exit;  
        
        

    }
    /*Name : Get Status Type
    Url  :http://103.51.153.235/project_management/public/index.php/api/getStatusType
    Date : 07/01/2019
    By   : Suvarna*/
    public function getStatusType(Request $request)
    {
        $user =$this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $statusType = array();
        $status_Types = ProgressStatusType::all();
        foreach ($status_Types as  $value) 
        {
            $statusType[] = ['status_id' => (string)$value['progress_status_type_id'], 'status_type' =>  $value['progress_status_type']];
               
        }
        if(isset($statusType))
        {
            return json_encode(array('status' => '1','statusType' => $statusType));
            exit;
        }
        else
        {
            return json_encode(array('status' => '0','message' => "no values for Status Type"));
            exit;
        }
    }
    /*Name : Accept project from employee
    Url  :http://103.51.153.235/project_management/public/index.php/api/acceptProject
    Date : 08/01/2019
    By   : Suvarna*/
    public function acceptProject(Request $request)
    {
        $user =$this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $projectid = $request['projectid'];
        $employeeType = $user->associate_type_id;
        $userid = $request['userid'];
        if($employeeType == 1)
        {
            $project = Project::where('project_id','=',$projectid)->first();
            $projectbid = new ProjectBid;
            $projectbid->project_id = $projectid;
            $projectbid->user_id = $request['userid'];
            $projectbid->associate_suggested_bid = $project->approx_bid;
            $projectbid->project_bid_status = 1;
            $projectbid->bid_status = 1;
            $projectbid->created_at = date('Y-m-d H:i:s');
            $projectbid->accepted_rejected_at = date('Y-m-d H:i:s');
            $projectbid->save();
            $date = date('Y-m-d H:i:s');
            //reject other's bids
            $rejectuserbid = ProjectBid::where('user_id','<>', $userid)
                            ->where('project_id','=',$projectid)
                            ->where('bid_status','=',1)
                            ->where('project_bid_status','=',2)
                            ->get();
            ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','<>',1)
                            ->where('bid_status','=',1)
                            ->update(['project_bid_status' => 0,'accepted_rejected_at' => $date]);
            //update project status
            $model = new ProjectStatus;
            $model->project_id = $projectid;
            $model->project_status_type_id = 2;
            $model->created_at = $date;
            $model->save();
            $model = new ProjectStatus;
            $model->project_id = $projectid;
            $model->project_status_type_id = 3;
            $model->created_at = $date;
            $model->save();
            //$fromuserid = session('loginuserid');
            $project = Project::where('project_id','=',$projectid)->first();
            $managerid = $project->user_id;
            $fromuserid = $managerid;
            $managerid = $project->user_id;
            $body = $project->project_name;
            $user = User::where('users_id','=',$userid)->first();
            $projectid = (string)$projectid;
            $title = 'Job is allocated to '.$user->users_name;
            $msg = $title;
            $notificationid = '3';
            $this->sendUserNotification($managerid,$managerid,$projectid,$body,$title,$msg,$notificationid);
            if(isset($rejectuserbid))
            {
                $title = 'Sorry! Your bid was rejected';
                $msg = $title;
                $notificationid = '4';
                foreach ($rejectuserbid as $value) {
                    $rejectUserid = $value->user_id;
                    $this->sendUserNotification($rejectUserid,$managerid,$projectid,$body,$title,$msg,$notificationid);
                }
            }
            $title = 'Congratulations! Job was accepted!';
            $msg = $title;
            $notificationid = '3';
            $this->sendUserNotification($userid,$managerid,$projectid,$body,$title,$msg,$notificationid);
            return json_encode(array('status' => '1','message' => 'job Accepted successfully'));
            exit;
        }
        else
        {
            return json_encode(array('status' => '0','message' => 'Only employee can accepted this project'));
            exit;
        }
    }
    /*Name : Accept project from employee
    Url  :http://103.51.153.235/project_management/public/index.php/api/declineProject
    Date : 08/01/2019
    By   : Suvarna*/
    public function declineProject(Request $request)
    {
        $user =$this->checkuserprivatekey($request['userid'],$request['privatekey']);
        $projectid = $request['projectid'];
        $employeeType = $user->associate_type_id;
        $userid = $request['userid'];
        if($employeeType == 1)
        {
            $projectBidRequest  = ProjectBidRequest::where('project_id','=',$projectid)
                                                    ->where('to_user_id','=',$userid)
                                                    ->delete();
            return json_encode(array('status' => '1','message' => 'Job decline successfully'));
            exit;
        }
        else
        {
            return json_encode(array('status' => '0','message' => 'Only employee can accepted this job'));
            exit;
        }
    }
    
    
}
