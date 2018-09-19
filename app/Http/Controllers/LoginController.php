<?php

namespace App\Http\Controllers;

use Session;
use App\AdminUser;
use App\User;
use App\Project;
use App\ProjectBid;
use App\UserForgetPasswordRequest;
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
    

    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'admin_users_email' => 'required|email',
            'admin_users_password' => 'required',
        ]);

         $auth = AdminUser::where('admin_users_email', '=', $request->input('admin_users_email') )->where('admin_users_password', '=', $request->input('admin_users_password'))->first();

        if ($auth)
        {
            session(['loginuser' => $auth->admin_users_email]);
            session(['loginuserid' => $auth->admin_users_id]);
          
            session(['loginusername' => $auth->admin_users_name]);
            $associate = User::where('user_types_id','=','2')->count();
            $schedular = User::where('user_types_id','=','1')->count();
            $project = Project::all()->count();
            $projectbid = ProjectBid::all()->count();
            $users = User::where('user_types_id','=','2')
            ->where('users_approval_status','=','2')->paginate(8);
            return view('dashboard',[
            'associate'    => $associate, 
            'schedular'    => $schedular,
            'users'        => $users,
            'project'      => $project,
            'projectbid'   => $projectbid,
    ]);
        }else{
            $warning="email or password incorrect";
            
            return view('auth.login',compact('warning'));
        }
        
        /*if (auth()->guard('admin_users')->attempt(['admin_users_email' => $request->input('admin_users_email'), 'admin_users_password' => $request->input('admin_users_password')]))
        {
            return view('dashboard');
        }else{
            return redirect('/login');
        }*/
    }
     public function admin()
    {
        
        
        return view('dashboard');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('loginuser');
        $request->session()->flush();
        //session()->flush();
       
        return redirect()->action('LoginController@index');
    }
    public function forgotpassword(Request $request)
    {
        $user_id = $request->userid;
        $userid = base64_decode($user_id);
        return view('password.forgotpassword',['userid'=>$userid]);
        
    }
    public function changepassword(Request $request)
    {
        $this->validate($request, [
            'new_password'=>'required|min:6|max:12',
            'confirm_password'=>'required|min:6|max:12|same:new_password',
        ],
        $message = [
            'new_password.required' => 'The New Password field is required.',
            'confirm_password.required' => 'The Confirm password field is required.',
            'confirm_password.same' => 'Confirm Password does not match to New password.',
        ]);
        $newpw = Hash::make($request->new_password);
        $model=User::where('users_id','=',$request->userid)->update(['users_password' =>$newpw]);
        $date = date('Y-m-d H:i:s');
        $forgotpwd=UserForgetPasswordRequest::where('users_id','=',$request->userid)->get();
        foreach ($forgotpwd as  $value) {
            $forgotpwdid = $value->user_forget_password_request_id;
        }

        $model=UserForgetPasswordRequest::where('users_id','=',$request->userid)->
        where('user_forget_password_request_id','=',$forgotpwdid)->update(['password_updated_flag' => 1]);
        $model=UserForgetPasswordRequest::where('users_id','=',$request->userid)->
        where('user_forget_password_request_id','=',$forgotpwdid)->update(['password_updated_date' => $date]);
        if(isset($model))
        {
            /*echo json_encode(array('status' => '1', 'message' => "Password changed successfully "));
            exit;*/
            return view('password.forgotpassword');
        }
        else
        {
            echo json_encode(array('status' => '0', 'message' => "Password does not changed"));
            exit;
        }
    }
}
