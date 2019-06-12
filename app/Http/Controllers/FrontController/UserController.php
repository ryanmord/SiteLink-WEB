<?php

namespace App\Http\Controllers\FrontController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\User;
use App\ScopePerformed;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $scope = ScopePerformed::all();
        $request = new Request;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $object = new ApiController;
        $profile = $object->userProfile($request);
        $profile = json_decode($profile, true);
        $user = $object->getprofile($request);
        $user = json_decode($user, true);
        $request['pagenumber'] = 1;
        $request['limit'] = 4;
        $reviews =$object->userReview($request);
        $reviews = json_decode($reviews, true);
        return view('frontview.dashboard.myprofile',['scope'   => $scope,
                                                    'profile'  => $profile,
                                                    'user'     => $user,
                                                    'reviews'  => $reviews,
                                                    'userid'   => $request['userid']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $this->validate($request, [
            'name'                  => 'required|max:50',
            'lastname'              => 'required|max:50',
            'company'               => 'required|max:255',
            'email'                 => 'email|required|max:255',
            'phone'                 => 'required|min:17',
            'address'               => 'required',
        ]);
        $scope = $request['scope_performed'];
        $scope = implode (", ", $scope);
        $request['scopeperformed'] = $scope;
        //return response()->json($scope);
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $object = new ApiController;
        $response = $object->updateprofile($request);
        $response = json_decode($response, true);
        $user = User::where('users_id','=',$request['userid'])->first();
        $request->session()->forget('profileImage');
        session(['profileImage' => $user->users_profile_image]);
        /*echo "<pre>";
        echo session('profileImage');
        exit;*/
        return response()->json($response);
        exit;

    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'          => 'required',
            'new_password'          => 'required|min:6',
            'confirm_password'      => 'required|min:6',
        
        ]);
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['password'] = $request['new_password'];
        $request['oldpassword'] = $request['old_password'];
        $object = new ApiController;
        $response = $object->changepassword($request);
        $response = json_decode($response, true);
        return response()->json($response);
        exit;
    }
    public function userReviewPagination(Request $request)
    {
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 4;
        $reviews =$apiobj->userReview($request);
        $reviews = json_decode($reviews, true);
        $appendLi = "";
        if($reviews['status'] == 1) {
            if (isset($reviews['userreview'])) {
                $i = 1;
                foreach ($reviews['userreview'] as  $value) {
                    $appendLi .= '<li><img src="'.$value['profileimage'].'"/>  
                        <div class="name-rating"><h5>'.$value['username'].'</h5><span><i class="fa fa-star"></i>'.$value['rating'].'</span></div><p>'.$value['comment'].'</p><div class="notification-date">'.$value['commentdate'].'</div></li>';
                    ++$i;
                }
                $status = 1;

            }
            else
            {
                $status = 0;
            }
        }
        else
        {
            $status = 0;
        }
       
        $temp = array('appendLi' => $appendLi,
                      'status'   => $status
                    );

        return response()->json($temp);
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
