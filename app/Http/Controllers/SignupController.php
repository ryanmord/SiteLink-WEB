<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\UserRegistered;
use App\EmailVerification;
use App\UserForgetPasswordRequest;
use App\Mail\ForgotPassword;
use Mail;
use File;
use Image;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class SignupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function emailverification()
    {
        return view('signup.verifyemail');
    }
    public function checkverifycode(Request $request)
    {
            $email = $request['user_email'];
            $verifycode = $request['verification_code'];
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
                    
                    $warning="Verification code was valid for 24 hours please click on resend";
                    return response()->json(['error' => $warning]);
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
                   $usertype = $user->user_types_id;
                    return response()->json(['success' => 'Email verification successfully',
                                            'usertype' => $usertype]);
                    exit;
                }
                else
                {
                    $warning="Verification code is incorrect";
                    return response()->json(['error' => $warning]);
                    exit;
                }
            }
            else
            {
                $warning="Your email id is incorrect";
                return response()->json(['error' => $warning]);
                exit;
            }
    }
    public function resendcode(Request $request)
    {
        $email = $request['user_email'];
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
                    
                    return response()->json(['success' => 'Email resend successfully. Please check your email inbox']);
                    exit;
                    
               }    

            }
            else
            {
                $warning="Your email id is incorrect";
                return response()->json(['error' => $warning]);
                exit;
            }
    }
    public function managerSignUp()
    {
        return view('signup.manager');
    }
    public function storeUserDetail(Request $request)
    {
        $password = $request['customers_password'];
        $confirm_password = $request['confirm_password'];
        $email = $request['customers_email'];
        $flag = strcmp($password, $confirm_password); 
        if($flag != 0)
        {
            $warning="Your password and confirm password does not match";
            return response()->json(['error' => $warning]);
            exit;
        }
        $user = User::where('users_email','=',$email)->first();
        if(isset($user))
        {
            $warning="this user is already registered";
            return response()->json(['error' => $warning]);
            exit;
        }

        $name = $request['first_name'];
        $lastname = $request['lastname'];
        $company = $request['customers_company'];
        $password = $request['customers_password'];
        $phone = $request['customers_phone'];
        $model = new User;
        $file = $request->file('files');
        if(isset($file))
        {
            $destinationPath = public_path('img/users');
            $image_name = time() . "-" . $file->getClientOriginalName();
            $path = $file->move($destinationPath, $image_name);
            $model->users_profile_image = $image_name;

        }
        else 
        {
            $path = "default.png";
            $model->users_profile_image = $path;
        }
        $model->users_email = $email;
        $model->user_types_id = 1;
        $model->users_name = $name;
        $model->last_name = $lastname;
        $model->users_company = $company;
        $model->users_password = Hash::make($password);
        $model->users_phone = $phone;
        $model->save();
        $user = User::where('users_email','=',$email)->first();
        $verifycode = str_random(8);
        $emailverify = new EmailVerification;
        $emailverify->user_id = $user->users_id;
        $emailverify->verification_code = $verifycode;
        $emailverify->status = 1;
        $emailverify->created_at = date('Y-m-d H:i:s');
        $emailverify->save();
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
        Mail::to($email)->send(new UserRegistered($user,$verifycode,$action));
        return response()->json(['success' => 'user registration successfully']);
        exit;
            
    }
    public function forgotpassword(Request $request)
    {
        $email = $request['femail'];
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
            $url = url('/forgotPassword/'.$userid);
            Mail::to($useremail)->send(new ForgotPassword($user,$url));
            $warning="password reset link send on your email..please check your email";
            return response()->json(['success' => $warning]);
            exit;
        }
        else
        {
            $warning="Please check your email address";
            return response()->json(['error' => $warning]);
            exit;
        }
    }
}
