<?php

namespace App\Http\Controllers;

use Session;
use App\AdminUser;
use App\User;
use App\Project;
use App\ProjectBid;
use App\UserForgetPasswordRequest;
use App\ProjectStatus;
use App\ScopePerformed;
use DateTime;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }
    public function index()
    {

        return view('auth.login');
    }
    public function test(Request $request)
    {
        $flag = ApiController::test();
        echo $flag;

    }
    public function adminAuth(Request $request)
    {
        
        /*login for  admin user*/
        $email = $request->input('admin_users_email');  
        $password = $request->input('admin_users_password');
        
        $usertype = $request->input('customertype');
        if($usertype == 2)
        {
            $auth = AdminUser::where('admin_users_email', '=',$email)->first();
            if(isset($auth))
            {
                if(Hash::check($password, $auth->admin_users_password))
                {
                    session(['loginuser' => $auth->admin_users_email]);
                    session(['loginuserid' => $auth->admin_users_id]);
                    session(['loginusername' => $auth->admin_users_name]);
                    session(['loginusertype' => 'admin']);
                }
                else
                {
                    $warning="Your password incorrect";
                    return response()->json(['error' => $warning,'emailStatus' => 0]);
                    exit;
                }
                
            }
            else
            {
                $warning="Your email incorrect";
                return response()->json(['error' => $warning,'emailStatus' => 0]);
                exit;
            }
        }
        else
        {
            
            /*login for project manager user */
            $user = User::where('users_email','=',$email)->first();
            if(isset($user) && !empty($user))
            {
                $approvalStatus = $user->users_approval_status;
                if($approvalStatus == 3)
                {
                    $warning = "Your profile was bloacked";
                    return response()->json(['error' => $warning]);
                    exit;
                }
                $emailstatus = $user->email_status;
                $usertype = $user->user_types_id;
                /* usertype 1 for project manager and 2 for associate */
                if($usertype == 1)
                {
                    
                /* emailstatus 1 for verified email 0 for not verified email*/
                    if($emailstatus == 1)
                    {
                        if(Hash::check($password, $user['users_password']))
                        {
                            $auth = $user;
                            session(['loginuser'     => $auth->users_email]);
                            session(['loginuserid'   => $auth->users_id]);
                            session(['loginusername' => $auth->users_name]);
                            session(['loginusertype' => 'manager']);
                           
                            $deviceid   = $request['deviceid'];
                            $devicetype = 3;
                        }
                        else
                        {
                            $warning="Your password is incorrect";
                            return response()->json(['error' => $warning,'emailStatus' => 0]);
                            exit;
                        }
                    }
                    else
                    {
                        $warning="Please verify your email address";
                        return response()->json(['error' => $warning,'emailStatus' => 1]);
                        exit;
                    }
                }
                else
                {
                    $warning="Sorry you cannot login here";
                    return response()->json(['error' => $warning,'emailStatus' => 0]);
                    exit;
                }
            }
            else
            {
                $warning="Your email or password incorrect";
                return response()->json(['error' => $warning,'emailStatus' => 0]);
                exit;
            }
        }
        if(isset($auth))
        {

            if(session('loginusertype') == 'manager')
            {
                return response()->json(['success' => 'Login successfully',
                                        'usertype' => 2]);
            }
            //user type 1 for admin
            return response()->json(['success' => 'Login successfully',
                                    'usertype' => 1]);
            exit;
            
  
        }
        else
        { 
            
            return response()->json(['error' => "email or password incorrect"]);
            exit;
        }
    }
    public function admin()
    {
        return view('dashboard');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('loginuser');
        //destroy the session values
        $request->session()->flush();
        return redirect()->action('LoginController@index');
    }
    public function forgotpassword(Request $request)
    {
        $user_id = $request->userid;
        $userid = base64_decode($user_id);
        $forgotpassword = UserForgetPasswordRequest::where('users_id','=',$userid)
                                                    ->get();
        if(isset($forgotpassword))
        {
            foreach($forgotpassword as $value) 
            {
                $flag = $value->password_updated_flag;
            }
        }
        else
        {
            $forgotpassword = 0;
        }
        return view('password.forgotpassword',['userid'=>$userid,'flag'=>$flag]);
        
    }
    public function changepassword(Request $request)
    {
        $password = $request['new_password'];
        $confirm_password = $request['confirm_password'];
        $flag = strcmp($password, $confirm_password); 
        if($flag != 0)
        {
            $warning="Your password and confirm password does not match";
            return response()->json(['error' => $warning]);
            exit;
        }
        //encrypt password field
        $newpw = Hash::make($request['new_password']);
        $model=User::where('users_id','=',$request['userid'])->update(['users_password' =>$newpw]);
      
        $date = date('Y-m-d H:i:s');
        $forgotpwd = UserForgetPasswordRequest::where('users_id','=',$request['userid'])->get();
        foreach ($forgotpwd as  $value) {
            $forgotpwdid = $value->user_forget_password_request_id;
        }
        $model=UserForgetPasswordRequest::where('users_id','=',$request['userid'])->
        where('user_forget_password_request_id','=',$forgotpwdid)->update(['password_updated_flag' => 1]);
        $model=UserForgetPasswordRequest::where('users_id','=',$request['userid'])->
        where('user_forget_password_request_id','=',$forgotpwdid)->update(['password_updated_date' => $date]);
        if(isset($model))
        {
           
            return response()->json(['success' => 'Password reset successfully']);
            exit;
        }
      
    }
    public function signup()
    {
        return view('signup.manager');
    }

}
