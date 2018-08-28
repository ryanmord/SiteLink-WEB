<?php

namespace App\Http\Controllers;
use App\User;
use App\UserScopePerformed;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Image;
use Mail;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ApiController extends Controller
{
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
    			//$model->users_password = Hash::make($password);
    			$model->users_password = $password;
    			$model->users_phone = (int)$request['phone'];
    			if(isset($request['address']))
    			{
    				$model->users_address = $request['address'];
    			}
    			else
    			{
    				$model->users_address = "-";
    			}
    			//$model->users_enrolled = date('Y-m-d H:i:s');
    			$model->save();
    			$user = User::where('users_email','=',$email)->first();
    			if(isset($request['scope']))
    			{
    				
    				//$user = User::where('users_email','=',$email)->first();
    				$userid = $user->users_id;
					$scopeperformed = new UserScopePerformed;
					$scopeperformed->users_id = $userid;
					$scopeperformed->scope_performed_id = $request['scope'];
					$scopeperformed->last_updated = date('Y-m-d H:i:s');
					$scopeperformed->save();
    			}
    			
    			echo json_encode(array('status' => '1','message' => "User registration succesfully"));
    			exit;
			}
    		else
    		{
    			echo json_encode(array('status' => '0','message' => "Mandatory Parameter is Missing"));
    			exit;
    		}
    	}
    }
    public function userlogin(Request $request)
    {

    }
}
