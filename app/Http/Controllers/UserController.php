<?php
namespace App\Http\Controllers;
use App\User;
use App\UserType;
Use App\UserScopePerformed;
Use App\ScopePerformed;
use App\AdminUser;
use App\Project;
use App\ProjectBid;
use App\UserReview;
use App\Mail\Approveduser;
use App\Mail\Rejectapproval;
use App\Mail\BlockUnblockUser;
use App\Http\Controllers\ApiController;
use App\ProjectStatus;
use App\AssociateType;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DateTime;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        
        //$usertype = UserType::all();
       
        return view('user.associate_manager');
    }
    public function associateList(Request $request)
    {
        $column_key = array("0"=>"users_id","1"=>"users_name","2"=>"users_company","3"=>"users_email","4"=>"users_address","5"=>"created_at","6"=>"users_status");
      
        $order_key  = $request['order_key'];
        $order      = $column_key[$order_key];
        $sortorder  = $request['sortorder'];
        if($sortorder == 1)
        {
            $sort =  'asc';
        }
        else
        {
            $sort =  'desc';
        }
        /*echo $order;
        echo $sort;
        exit;*/
        $appendtd = '';
        $users = DB::table('users')
                            ->select('users.*')
                            ->where('user_types_id','=','2')
                            ->where('users_approval_status','<>','0')
                            ->orderBy($order,$sort)
                            /*->limit($limit)
                            ->offset($items)*/
                            ->get();
        /*print_r($projects);
        exit;*/
        $userCount = $users->count();
        if(isset($users) && !empty($users))
        {
            foreach ($users as  $value) {
                
                $createdAt   = $value->created_at;
                $createdDate = new DateTime($createdAt);
                $createdDate = $createdDate->format('m/d/Y');
                $userScope = UserScopePerformed::select('scope_performed_id')
                             ->where('users_id','=',$value->users_id)->first();
                $scopevalue = '';
                if(isset($userScope) && !empty($userScope))
                {
                    $scope  = $userScope->scope_performed_id;
                    $temp   = explode(",", $scope);
                    $count  = count($temp);
                    $i = 1;
                    foreach($temp as $scopes)
                    {
                        $scopePerformed = ScopePerformed::select('scope_performed')
                                                          ->where('scope_performed_id','=',$scopes)
                                                          ->first();
                        if(isset($scopePerformed) && !empty($scopePerformed))
                        {
                            $scopevalue .= $scopePerformed->scope_performed;
                            if($i < $count)
                            {
                                $scopevalue .= ', ';
                            }
                            $i++;
                        }
                    }
                }
                
                $profileimage = asset("/img/users/" . $value->users_profile_image);
                $appendtd .= '<tr class="content">
                            <td class="table-td-data">'.$value->users_id.'</td>';
                $appendtd .= '<td><img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "'.$profileimage.'" /></td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_name.' '.$value->last_name.'</td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_company.'</td>';
                $appendtd .= ' <td style="text-align: left;">'.$value->users_email.'<br>
                            '.$value->users_phone.'
                          </td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_address.'</td>';
                $appendtd .= ' <td class="table-td-data">'.$scopevalue.'</td>';
                $appendtd .= ' <td class="table-td-data">'.$createdDate.'</td>';
                if($value->users_status == 1)
                {
                    $appendtd .= '<td style="color: #5B8930;">
                                <span class="glyphicon glyphicon-ok"></span></td>';
                }
                else
                {
                    $appendtd .= '<<td style="color: #DB5A6B;">
                                <span class="glyphicon glyphicon-remove"></span></td>';
                }
                $appendtd .= ' <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                  <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                    right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">';
                                    if($value->users_approval_status == 3)
                                    {
                                        $appendtd .= '<li><a href="'.url('users/user/'.$value->users_id.'/1').'">Unblock
                                      </a>
                                      </li>';
                                    }
                                    else
                                    {
                                        $appendtd .= ' <li><a href="'.url('users/user/'.$value->users_id.'/3').'">Block</a>
                                      </li>';
                                    }
                $appendtd .= '<li><a href="'.url('projects/'.$value->users_id).'">Projects</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>';
            }
            
        }
        return json_encode(array('count' => $userCount,'appendtd' => $appendtd));
    }
    public function managerList(Request $request)
    {
        $column_key = array("0"=>"users_id","1"=>"users_name","2"=>"users_company","3"=>"users_email","4"=>"created_at","5"=>"users_status");
      
        $order_key  = $request['order_key'];
        $order      = $column_key[$order_key];
        $sortorder  = $request['sortorder'];
        if($sortorder == 1)
        {
            $sort =  'asc';
        }
        else
        {
            $sort =  'desc';
        }
        /*echo $order;
        echo $sort;
        exit;*/
        $appendtd = '';
        $users = DB::table('users')
                            ->select('users.*')
                            ->where('user_types_id','=','1')
                            ->where('users_approval_status','<>','0')
                            ->orderBy($order,$sort)
                            /*->limit($limit)
                            ->offset($items)*/
                            ->get();
        /*print_r($projects);
        exit;*/
        $userCount = $users->count();
        if(isset($users) && !empty($users))
        {
            foreach ($users as  $value) {
                
                $createdAt   = $value->created_at;
                $createdDate = new DateTime($createdAt);
                $createdDate = $createdDate->format('m/d/Y');
                $profileimage = asset("/img/users/" . $value->users_profile_image);
                $appendtd .= '<tr class="content">
                            <td class="table-td-data">'.$value->users_id.'</td>';
                $appendtd .= '<td><img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "'.$profileimage.'" /></td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_name.' '.$value->last_name.'</td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_company.'</td>';
                $appendtd .= ' <td style="text-align: left;">'.$value->users_email.'<br>
                            '.$value->users_phone.'
                          </td>';
                $appendtd .= ' <td class="table-td-data">'.$createdDate.'</td>';
                if($value->users_status == 1)
                {
                    $appendtd .= '<td style="color: #5B8930;">
                                <span class="glyphicon glyphicon-ok"></span></td>';
                }
                else
                {
                    $appendtd .= '<<td style="color: #DB5A6B;">
                                <span class="glyphicon glyphicon-remove"></span></td>';
                }
                $appendtd .= ' <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                  <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                    right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">';
                                    if($value->users_approval_status == 3)
                                    {
                                        $appendtd .= '<li><a href="'.url('users/user/'.$value->users_id.'/1').'" onclick="return confirm("Are you want to sure unblock this user?")">Unblock
                                      </a>
                                      </li>';
                                    }
                                    else
                                    {
                                        $appendtd .= ' <li><a href="'.url('users/user/'.$value->users_id.'/3').'" onclick="return confirm("Are you want to sure block this user?")">Block</a>
                                      </li>';
                                    }
                $appendtd .= '<li><a href="'.url('projects/'.$value->users_id).'">Projects</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>';
            }
            
        }
        return json_encode(array('count' => $userCount,'appendtd' => $appendtd));
    }
    public function setNewPassword(Request $request)
    {
        $user_id = $request->userid;
        $userid  = Crypt::decrypt($user_id);
        return view('password.setNewPassword',['userid' => $userid]);
    }
    public function updateNewPassword(Request $request)
    {
        $userid   = $request['userid'];
        $email    = $request['useremail'];
        $user     = User::where('users_id','=',$userid)
                         ->where('users_email','=',$email)->first();
        if(isset($user))
        {
            $password = $request['new_password'];
            $confirm_password = $request['confirm_password'];
            //encrypt password field
            $newpw = Hash::make($request['new_password']);
            $model = User::where('users_id','=',$userid)
                    ->where('users_email','=',$email)
                    ->update(['users_password' =>$newpw]);
            if(isset($model))
            {
                return response()->json(['success' => 'Password Set Successfully']);
                exit;
            }
            else
            {
                return response()->json(['failure' => 'Password does not reset successfully']);
                exit;
            }
        }
        else
        {
            $warning="Your email address is incorrect";
            return response()->json(['error' => $warning]);
            exit;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
    public function edit($id)
    {
        //
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
       $userid = session('loginuserid');
        if(isset($request['first_name']))
        {
            $name  = $request['first_name'];
            $model = User::where('users_id', '=',$userid)
                            ->update(['users_name' => $name]);
        }
        if(isset($request['lastname']))
        {
            $lastname  = $request['lastname'];
            $model = User::where('users_id', '=',$userid)
                            ->update(['last_name' => $lastname]);
        }
        if(isset($request['customers_company']))
        {
            $company = $request['customers_company'];
            $model   = User::where('users_id', '=',$userid)
                            ->update(['users_company' => $company]);
        }
        if(isset($request['customers_phone']))
        {
            $phone = $request['customers_phone'];
            $model = User::where('users_id', '=',$userid)
                            ->update(['users_phone' => $phone]);
        }
       
        $file = $request->file('files');
        if(isset($file))
        {
            $destinationPath = public_path('img/users');
            $model = User::where('users_id', '=',$userid)->first();
            $image = $model->users_profile_image;
              
            if(file_exists(public_path('img/users/'.$image)))
            {
                    unlink(public_path('img/users/'.$image));
            }
            
            $image_name = time() . "-" . $file->getClientOriginalName();
            $path = $file->move($destinationPath, $image_name);
            //$path = "img/users/" . $image_name;
            $profileimage = $image_name;
            $model = User::where('users_id', '=',$userid)
                            ->update(['users_profile_image' => $profileimage]);
        }
        $warning="Profile updated successfully";
        return response()->json(['success' => $warning]);
        exit;
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function dashboard()
    {
        
        $associate    = User::where('user_types_id','=','2')
                              ->where('users_approval_status','=',1)->count();
        $schedular    = User::where('user_types_id','=','1')->count();
        $projectcount = Project::all()->count();
        $project      = DB::table('projects')
                        ->select('projects.*')
                        ->leftJoin('project_status', 'project_status.project_id', '=', 'projects.project_id')
                        ->orderBy('project_status.created_at','desc')
                        ->get();
        $associatetype   = AssociateType::all();
        $projectbidcount = ProjectBid::where('bid_status','=',1)
                                       ->count();
        //$projectcount = $project->count();
        $users = User::where('users_approval_status','=',2)
                        ->where('user_types_id','=',2)
                        ->orderBy('users_id','desc')->get();
        $schedulingProjectCount = DB::table('projects')
                            ->select('projects.*','users_name')
                            ->leftJoin('project_status','project_status.project_id','=','projects.project_id')
                            ->leftJoin('users','users.users_id','=','projects.user_id')
                            ->where('project_status.project_status_type_id','=',7)
                            ->count();
        if(!isset($users) && empty($users))    
        {
            $users = null;
        }          
        /*if(isset($nonallocatedproject))
        {
            $bidsrequestcount = ProjectBid::where('project_bid_status','=',2)
                                                ->where('bid_status','=',1)->count();
        }
        else
        {
            $bidsrequestcount = 0;
            $nonallocatedproject = null;
        }*/
             
        
       /* print_r($nonallocatedproject);
        exit;*/
        /*echo json_encode(array('publishprojects' => $bids));
            exit;  */
        return view('dashboard',[
                    'associate'              => $associate, 
                    'schedular'              => $schedular,
                    'project'                => $projectcount,
                    'projectbid'             => $projectbidcount,
                    'users'                  => $users,
                    'associatetype'          => $associatetype,
                    'schedulingProjectCount' => $schedulingProjectCount
                 ]);
        
  
    }
    public function approveduser(Request $request)
    {
        $adminid = session('loginuserid');
        $date    = date("Y-m-d H:i:s");
        
        $status = $request['status'];
        $id = $request['userid'];
       //status 1 for approved user

        if($status == 1)
        {
            $associatetype =  $request->input('optradio');
            $id = $request->input('userid');
            User::where('users_id','=', $id)
            ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date,'associate_type_id' => $associatetype]);
            $user = User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
             //to set near by available projects to that user
            $apiobj = new ApiController;
            $apiobj->updateavailableProject($id);
            Mail::to($useremail)->send(new Approveduser($user));
            session()->flash('message', 'Approval status has been updated successfully');
            return redirect()->action('UserController@dashboard');
        }
        // else part for reject user
        else
        {
            User::where('users_id','=', $id)
                  ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date]);
            $user=User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
            Mail::to($useremail)->send(new Rejectapproval($user));
            session()->flash('message', 'Approval status has been updated successfully');
            return json_encode(array('message' => 'success'));
        }
       
    }
    public function blockUnblockUser($id,$status)
    {
        $adminid = session('loginuserid');
        $date    = date("Y-m-d H:i:s");
        User::where('users_id','=', $id)
               ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date]);
       //status 3 for blocked user
        if($status == 3)
        {
            $action = 1;
            $user=User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
            Mail::to($useremail)->send(new BlockUnblockUser($user,$action));
            session()->flash('message', 'user blocked successfully');
            return redirect()->action('UserController@index');
        }
        //status 2 for unblock user
        else
        {
            $action = 2;
            $user=User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
            Mail::to($useremail)->send(new BlockUnblockUser($user,$action));
            session()->flash('message', 'user unblocked successfully');
            return redirect()->action('UserController@index');
        }
        

    }
    public function search(Request $request)
    {
        $approval_status = $request->status;
        $users = User::where('users_approval_status','=', $approval_status)->paginate(8);
        $usertype = UserType::all();
        return view('admin.user',[
                    'users'     => $users,
                    'usertype'  => $usertype,
                   ]);
    }
    public function adminuser()
    {
        //user type 4 for admin type user
        $users    = User::where('user_types_id','=','4')->paginate(8);
        $usertype = UserType::all();
        $count    = $users->count();
        return view('user.index',[
                    'users'       => $users, 
                    'usertype'    => $usertype,
                    'admin'       => $users,
                    'count'       => $count
                  ]);
       
    }
   public function managerDashboard()
   {
        $userid = session('loginuserid');
        $totalproject = Project::where('user_id','=',$userid)->count();
        $completeproject = DB::table('projects')
                            ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_status.project_status_type_id','=',4)
                            ->count();
        $cancelledproject = DB::table('projects')
                            ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_status.project_status_type_id','=',5)
                            ->count();
       /* $bidmadecount = DB::table('projects')
                            ->leftJoin('project_bids', 'projects.project_id', '=', 'project_bids.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_bids.project_bid_status','=',1)
                            ->count();*/
        $overdueprojectcount = 0;
        $inProgressCount = 0;
        $project = Project::where('user_id','=',$userid)->get();
        foreach ($project as $value) 
        {
            $reportduedate = $value->report_due_date;
            $reportduedate = new DateTime($reportduedate);
            $reportduedate= $reportduedate->format("Y-m-d");
            $projectstatus = ProjectStatus::where('project_id','=',$value->project_id)
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
                else
                {
                    $inProgressCount = $inProgressCount + 1;
                }                
            }
        }
        $inProgressCount = $inProgressCount + $overdueprojectcount;
        if($totalproject < 10)
        {
            $totalproject = '0'.(string)$totalproject;
        }
        if($inProgressCount < 10)
        {
            $inProgressCount = '0'.(string)$inProgressCount;
        }
        if($completeproject < 10)
        {
            $completeproject = '0'.(string)$completeproject;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        return view('managerdashboard',['totalproject'            => $totalproject,
                                            'completeproject'     => $completeproject,
                                            'overdueprojectcount' => $overdueprojectcount,
                                            'inProgressCount'     => $inProgressCount  ]);
        exit;

    }
    public function edituser()
    {
        $userid = session('loginuserid');
        $totalproject = Project::where('user_id','=',$userid)->count();
        $completeproject = DB::table('projects')
                            ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_status.project_status_type_id','=',4)
                            ->count();
        $cancelledproject = DB::table('projects')
                            ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_status.project_status_type_id','=',5)
                            ->count();
        /*$bidmadecount = DB::table('projects')
                            ->leftJoin('project_bids', 'projects.project_id', '=', 'project_bids.project_id')
                            ->where('projects.user_id','=',$userid)
                            ->where('project_bids.project_bid_status','=',1)
                            ->count();*/
        $overdueprojectcount = 0;
        $inProgressCount = 0;
        $project = Project::where('user_id','=',$userid)->get();
        foreach ($project as $value) 
        {
            $reportduedate = $value->report_due_date;
            $reportduedate = new DateTime($reportduedate);
            $reportduedate= $reportduedate->format("Y-m-d");
            $projectstatus = ProjectStatus::where('project_id','=',$value->project_id)
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
                else
                {
                    $inProgressCount = $inProgressCount + 1;
                }               
            }
        }
        $review = UserReview::where('to_user_id','=',$userid)->
                            where('user_review_status','=',1)->max('user_review_ratings');
        $userreview = UserReview::where('to_user_id','=',$userid)->
                            where('user_review_status','=',1)
                            ->orderBy('user_review_id', 'desc')->get();
        if(isset($userreview))
        {
            foreach($userreview as $value)
            {
                $byuserid = $value->from_user_id;
                $model = User::where('users_id','=',$byuserid)->first();
                $lastname = $model->last_name;
                $username = $model->users_name.' '.$lastname;
                $profileimage =  $model['users_profile_image'];
                $commentdate = $value->created_at;
                $commentdate = new DateTime($commentdate);
                $commentdate = $commentdate->format("jS F Y h:i A");
                $userreview1[] = ['profileimage' => $profileimage, 
                                  'username'     =>  $username, 
                                  'rating'       => $value->user_review_ratings,
                                  'comment'      => $value->user_review_comments,
                                  'commentdate'  => $commentdate];
                
            }
        }
        else
        {
            $userreview1 = 0;
        }
        if(!isset($userreview1)) 
        {
            $userreview1 = 0;
        }
        
        if(!isset($review))
        {
            $review = '0.0';
        }
        $inProgressCount = $inProgressCount + $overdueprojectcount;
        if($inProgressCount < 10)
        {
            $inProgressCount = '0'.(string)$inProgressCount;
        }
        if($completeproject < 10)
        {
            $completeproject = '0'.(string)$completeproject;
        }
        if($overdueprojectcount < 10)
        {
            $overdueprojectcount = '0'.(string)$overdueprojectcount;
        }
        $user = User::where('users_id','=',$userid)->first();
        $lastname = $user->last_name;
        $username = $user->users_name.' '.$lastname;
        $usertype = $user->user_types_id;
        $profileimage =  $user->users_profile_image;
        return view('user.edituser',['totalproject'       => $totalproject,
                                    'completeproject'     => $completeproject,
                                    'overdueprojectcount' => $overdueprojectcount,
                                    'inProgressCount'     => $inProgressCount,
                                    'review'              => $review,
                                    'username'            => $username,
                                    'profileimage'        => $profileimage,
                                    'user'                => $user,
                                    'userreview'          => $userreview1 ]);
        exit;

        
    }
    public function changepassword(Request $request)
    {
        $userid = session('loginuserid');
        $oldpassword = $request['old_password'];
        $password = $request['new_password'];
        $confirm_password = $request['confirm_password'];
        $flag = strcmp($password, $confirm_password); 
        if($flag != 0)
        {
            $warning="Your password and confirm password does not match";
            return response()->json(['error' => $warning]);
            exit;
        }
        $user = User::where('users_id','=',$userid)->first();
        if(Hash::check($oldpassword, $user->users_password))
        {
            $hashpassword = Hash::make($password);
            $model = User::where('users_id', '=',$userid)
                    ->update(['users_password' => $hashpassword]);
            $warning="Password changed successfully";
            return response()->json(['success' => $warning]);
            exit;
            
        }
        else
        {
            $warning="Old password is incorrect";
            return response()->json(['error' => $warning]);
            exit;
            
        }
    }
    public function pendingAssociateList(Request $request)
    {
        $column_key = array("0"=>"users_id","1"=>"users_name","2"=>"users_company","3"=>"users_email","4"=>"users_address","5"=>"created_at");
      
        $order_key  = $request['order_key'];
        $order      = $column_key[$order_key];
        $sortorder  = $request['sortorder'];
        if($sortorder == 1)
        {
            $sort =  'asc';
        }
        else
        {
            $sort =  'desc';
        }
        /*echo $order;
        echo $sort;
        exit;*/
        $appendtd = '';
        $users = DB::table('users')
                            ->select('users.*')
                            ->where('user_types_id','=','2')
                            ->where('users_approval_status','=','2')
                            ->orderBy($order,$sort)
                            /*->limit($limit)
                            ->offset($items)*/
                            ->get();
        /*print_r($projects);
        exit;*/
        $userCount = $users->count();
        if(isset($users) && !empty($users))
        {
            foreach ($users as  $value) {
                
                $createdAt   = $value->created_at;
                $createdDate = new DateTime($createdAt);
                $createdDate = $createdDate->format('m/d/Y');
                $userScope = UserScopePerformed::select('scope_performed_id')
                             ->where('users_id','=',$value->users_id)->first();
                $scopevalue = '';
                if(isset($userScope) && !empty($userScope))
                {
                    $scope  = $userScope->scope_performed_id;
                    $temp   = explode(",", $scope);
                    $count  = count($temp);
                    $i = 1;
                    foreach($temp as $scopes)
                    {
                        $scopePerformed = ScopePerformed::select('scope_performed')
                                                          ->where('scope_performed_id','=',$scopes)
                                                          ->first();
                        if(isset($scopePerformed) && !empty($scopePerformed))
                        {
                            $scopevalue .= $scopePerformed->scope_performed;
                            if($i < $count)
                            {
                                $scopevalue .= ', ';
                            }
                            $i++;
                        }
                    }
                }
                $profileimage = asset("/img/users/" . $value->users_profile_image);
                $appendtd .= '<tr class="content">
                            <td class="table-td-data">'.$value->users_id.'</td>';
                $appendtd .= '<td><img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "'.$profileimage.'" /></td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_name.' '.$value->last_name.'</td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_company.'</td>';
                $appendtd .= ' <td style="text-align: left;">'.$value->users_email.'<br>
                            '.$value->users_phone.'
                          </td>';
                $appendtd .= '<td class="table-td-data">'.$value->users_address.'</td>';
                $appendtd .= ' <td class="table-td-data">'.$scopevalue.'</td>';
                $appendtd .= ' <td class="table-td-data">'.$createdDate.'</td>';
                
                $appendtd .= '<td style="text-align: center;vertical-align: middle;">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                      <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                        right: 100% !important;text-align: left !important;transform: translate(-75%, 0) !important;">
                                       <li><a href="#" id="approve" onclick="setuserid('.$value->users_id.')" data-toggle="modal" data-target="#myModal" data-id="'.$value->users_id.'">Approve</a>
                                        </li>

                                        <li><a href="#" onclick="confirmMsg('.$value->users_id.')">Reject</a>
                                        </li>
                   
                                      </ul>
                                      
                                    </div>
                                  </td>
                            </tr>';
            }
            
        }
        return json_encode(array('count' => $userCount,'appendtd' => $appendtd));
    }
}
