<?php

namespace App\Http\Controllers\FrontController;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\UserForgetPasswordRequest;
use App\Mail\UserRegistered;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\EmailVerification;
use App\ScopePerformed;
use App\User;
use DateTime;
use Image;
use Mail;
use File;

class SignupController extends Controller
{

	public function index() {
        $scope = ScopePerformed::all();
        return view('frontview.auth.signup',['scope' => $scope]);
    }

    public function register(Request $request){

        $this->validate($request, [
            'name'                  => 'required|max:50',
            'lastname'              => 'required|max:50',
            'company'               => 'required|max:255',
            'email'                 => 'email|required|max:255',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone'                 => 'required|min:17',
            'address'               => 'required',
        ]);

        $scope = $request['scope_performed'];
        $scope = implode (", ", $scope);
        $request['scope']    = $scope;
        $request['usertype'] = 2;
        $api = new ApiController;
        $userProfileData = $api->signup($request);
        $userProfileData = json_decode($userProfileData, true);
        return response()->json($userProfileData);
        exit;
    	/*
        if ($userProfileData['status'] == 1) {
            return redirect()->route('emailVerify')->with($userProfileData['status'], $userProfileData['message']);
        }
        else{
            return redirect()->route('signUp')->with('error', $userProfileData['message']);
        }*/
    }

}