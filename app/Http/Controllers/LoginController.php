<?php

namespace App\Http\Controllers;

use Session;
use App\AdminUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
            $users = User::where('user_types_id','=','2')
            ->where('users_approval_status','=','2')->paginate(8);
            return view('dashboard',[
            'associate'    => $associate, 
            'schedular'    => $schedular,
            'users'        => $users,
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
        $request->session()->flush(); 
       
        return redirect()->action('LoginController@index');
    }
    

   /*public function getUserLogin()
    {
        return view('adminlte::auth.login');
    }

    public function userAuth(Request $request)
    {
        $this->validate($request, [
            'user_email' => 'required|email',
            'user_password' => 'required',
        ]);
        if (auth()->attempt(['user_email' => $request->input('email'), 'user_password' => $request->input('password')]))
        {
            $user = auth()->admin_user();
            return redirect()->route('admin/');
        }else{
            dd('your username and password are wrong.');
        }
    }*/
}
