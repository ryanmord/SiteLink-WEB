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
        $associate = User::Where('users_approval_status','<>','0')
        ->where('user_types_id','=','2')
        ->orderBy('users_id','desc')
        ->paginate(8);
        $manager = User::Where('users_approval_status','<>','0')
        ->where('user_types_id','=','1')
        ->orderBy('users_id','desc')
        ->paginate(8);
        $managercount = $manager->count();
        $associatecount = $associate->count();
        //$usertype = UserType::all();
        $scopeperformed= ScopePerformed::all();
        return view('user.associate_manager',[
                    'manager'         => $manager, 
                    'associate'       => $associate,
                    'scopeperformed'  => $scopeperformed,
                    'managercount'    => $managercount,
                    'associatecount'  => $associatecount
                  ]);
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
        
        $associate = User::where('user_types_id','=','2')
                    ->where('users_approval_status','=',1)->count();
        $schedular = User::where('user_types_id','=','1')->count();
        $project = Project::all();
        $associatetype = AssociateType::all();
        $projectbidcount = ProjectBid::where('bid_status','=',1)->count();
        $projectcount = $project->count();
        $users = User::where('users_approval_status','=',2)
                        ->where('user_types_id','=',2)
                        ->orderBy('users_id','desc')->get();
        if(isset($project))
        {
            foreach($project as $value)
            {
                $managerid = User::where('users_id','=',$value->user_id)
                ->first();
                if(isset($managerid))
                {
                    $managername = $managerid->users_name;
                }
                $projectid = $value->project_id;
                $status = ProjectStatus::where('project_id','=',$projectid)->get();
                foreach($status as $value) 
                {
                    $statusvalue = $value->project_status_type_id;
                }
                if($statusvalue == 1)
                {
                    $publishproject = Project::where('project_id','=', $value->project_id)
                                                ->orderBy('project_id','desc')->first();
                    if(isset($publishproject))
                    {
                    $scope = $publishproject->scope_performed_id;
                    $data = [];
                    $temp = explode(",", $scope);
                    foreach($temp as $value) 
                    {
                        $scopeperformed = ScopePerformed::select('scope_performed_id','scope_performed')->where('scope_status','=','1')
                                 ->where('scope_performed_id','=',(int)$value)->first();
                                    $data[] = $scopeperformed->scope_performed;
                    }
                    $reportduedate = $publishproject['report_due_date'];
                    $datetime2 = new DateTime($reportduedate);
                    $reportduedate= $datetime2->format("Y-m-d");
                    $created_at = (String)$publishproject->created_at;
                    $datetime2 = new DateTime($created_at);
                    $created_at= $datetime2->format("Y-m-d");
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                    ->where('project_bid_status','=',2)
                    ->where('bid_status','=',1)->get();
                    $currentbidcount = $projectbid->count();
                    if($currentbidcount > 0)
                    {
                    foreach ($projectbid as $bid) 
                    {
                        $approxbid = number_format($publishproject->approx_bid, 2);
                        $associateid = $bid->user_id;
                        $user = User::where('users_id','=',$associateid)->first();
                        $associatebid = number_format($bid->associate_suggested_bid, 2);
                        $bids[] = ['projectid' => $bid->project_id, 
                        'associateid'   =>$associateid, 
                        'projectname'   => $publishproject->project_name,
                        'managername'   => $managername, 
                        'associatename' => $user->users_name,
                        'suggestedbid'  => $associatebid,
                        'approx_bid'    => $approxbid];
                    }
                    
                                  
                }

                

                    
                }

            }
            
                        
            }
                   
            }
            
            if(isset($projectbid))
            {
                if(isset($bids))
                {
                    $bidsrequestcount = count($bids);
                }
                else
                {
                    $bidsrequestcount = 0;
                    $bids = null;
                }
                
            }  
            else
            {
                  $bidsrequestcount = 0;
                  $bids = null;
            }
        /*echo json_encode(array('publishprojects' => $bids));
            exit;  */
        return view('dashboard',[
                    'associate'         => $associate, 
                    'schedular'         => $schedular,
                    'project'           => $projectcount,
                    'projectbid'        => $projectbidcount,
                    'users'             => $users,
                    'bidsrequestcount'  => $bidsrequestcount,
                    'bids'              => $bids,
                    'associatetype'     => $associatetype
        ]);
  
    }
    public function approveduser($id,$status,Request $request)
    {
        $adminid = session('loginuserid');
        $date    = date("Y-m-d H:i:s");
        $associatetype =  $request->input('optradio');
        
       //status 1 for approved user
        if($status == 1)
        {
            $id = $request->input('userid');
            User::where('users_id','=', $id)
            ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date,'associate_type_id' => $associatetype]);
            $user = User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
             //to set near by available projects to that user
            $apiobj = new ApiController;
            $apiobj->updateavailableProject($id);
            Mail::to($useremail)->send(new Approveduser($user));
        }
        // else part for reject user
        else
        {
            User::where('users_id','=', $id)
             ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date,'associate_type_id' => $associatetype]);
            $user=User::where('users_id','=',$id)->first();
            $useremail = $user->users_email;
             Mail::to($useremail)->send(new Rejectapproval($user));
           
        }
        session()->flash('message', 'Approval status has been updated successfully');
        return redirect()->action('UserController@dashboard');

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
    
    
}
