<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use App\Project;
use App\User;
use App\ProjectBid;
use App\ProjectStatus;
use App\ScopePerformed;
use App\ProjectStatusType;
use App\ProjectProgressStatus;
use App\ProjectNotificationSentDevice;
use App\Setting;
use App\UserDevice;
use App\UserAccessKey;
use App\ProjectNotification;
use App\ProjectBidRequest;
use App\AssociateType;
use App\UserScopePerformed;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Edujugon\PushNotification\Facades\PushNotification;
use Illuminate\Support\Facades\Redirect;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all()->paginate(8);
        return view('project.index',compact($projects));
    }
    public function viewStatus(Request $request)
    {
        $projectid = $request['projectid'];
        
        $request['pagenumber'] = 1;
        $request['limit']   = 3;
        $projectstatus = $this->progressstatus($request);
        $projectstatus = json_decode($projectstatus, true);
        if($projectstatus['status'] == 1)
        {
            $progressstatus = $projectstatus['progressstatus'];
            return response()->json($progressstatus);
        }
        else
        {
            $progressstatus = array('status' => 0);
            return response()->json($progressstatus);
        }
    }
    public function statusPagination(Request $request){
        $request['projectid'] = $request['projectid'];
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 3;
        $projectStatus = $this->progressstatus($request);
        $projectStatus = json_decode($projectStatus, true);
        $appendLi = "";
        if($projectStatus['status'] == 1) {

            if(!empty($projectStatus['progressstatus'])) {
                // $appendLi = '<h4>Available Job</h4>';
                
                foreach($projectStatus['progressstatus'] as  $value) {
                   $appendLi .= '<li> 
                    <h5>'.$value['subject'].'</h5>
                    <p>'.$value['status'].'</p>
                    <div class="status-date">'.$value['createddate'].'</div>
                 </li>';
                    
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
        /*print_r($temp);*/

        return response()->json($temp);
    }
    public function progressstatus(Request $request)
    {
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
                $date =$value->created_at;
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
            $errorMsg = array('status' => '0', 'message' => "No any status for this Project");
            return json_encode($errorMsg);
            exit;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //create new project
    public function create(Request $request)
    {
        
        //get miles range values
        $setting = Setting::where('setting_status','=',1)->first();
        if(isset($setting))
        {
            $minvalue = (string)$setting->min_miles;
            $maxvalue = (string)$setting->max_miles;
        }
        else
        {
            $minvalue = 0;
            $maxvalue = 0;
        }
        $scopeperformed = ScopePerformed::all();
        $associatetype = AssociateType::all();
        $user = User::select('users_id','users_name','last_name')
                ->where('user_types_id','=',1)
                ->where('users_status','=',1)
                ->where('users_approval_status','=',2)
                ->where('email_status','=',1)
                ->get();
        //$associate_list = $this->associateUserList();
        return view('project.createproject',[
                    'minvalue'      => $minvalue, 
                    'maxvalue'      => $maxvalue,
                    'scope'         => $scopeperformed,
                    'associatetype' => $associatetype,
                    'user'          => $user ]);
       
       

    }
   /* public function associateUserList()
    {
        $associatelist = User::select('users_id','users_name','last_name','users_status','users_email','users_phone','users_profile_image','users_company')->where('user_types_id','=',2)->where('users_status','=',1)->where('email_status','=',1)->where('users_approval_status','=',1)->orderBy('users_name','desc')->paginate(6);
        return($associatelist);
        
    }*/
    public function searchAssociate(Request $request){
        $pageno = $request['pagenumber'];
        $limit = $request['limit'];
        $searchKeyword = $request['search_user'];
        if(!empty($request['selectedAssociate']))
        {
            $selectedUser = $request['selectedAssociate'];
            $selectedUser = explode(",",$selectedUser);
            $selectedUser = array_unique($selectedUser);
        }
        if ($pageno < 1) 
        {
            $pageno = 1;
        }
        $start = ($pageno + 1);     
        $items = $limit * ($pageno - 1);   
        $where_condition = "1 = 1";
        if($searchKeyword != "") {
            $where_condition = "  (users_name Like  '%$searchKeyword%')";
            $userlist = DB::table('users')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS users_id'), 'users_name', 'users_email','users_address','users_company','users_phone','users_profile_image','last_name')
                            ->where('email_status','=',1)
                            ->where('users_status','=',1)
                            ->where('users_approval_status','=',1)
                            ->whereRaw($where_condition)
                            ->orderBy('users_name','desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
           
        }
        else{
            $userlist = DB::table('users')
                            ->select(DB::raw('SQL_CALC_FOUND_ROWS users_id'), 'users_name', 'users_email','users_address','users_company','users_phone','users_profile_image','last_name')
                            ->where('email_status','=',1)
                            ->where('users_status','=',1)
                            ->where('users_approval_status','=',1)
                            ->orderBy('users_name','desc')
                            ->limit($limit)
                            ->offset($items)
                            ->get();
        } 
        $count = DB::select(DB::raw("SELECT FOUND_ROWS() AS Totalcount;"));
        $usercount =  $userlist->count();
        $appendtd = '';
        if($usercount != 0)
        {
            foreach ($userlist as $value) {
                if(isset($request['projectid']))
                {
                    $bidrequest = ProjectBidRequest::where('to_user_id','=',$value->users_id)
                                                ->where('project_id','=',$request['projectid'])->first();
                }
                if(isset($bidrequest))
                {
                    $appendtd .= ' <tr class="content">
                                     <td><input type="checkbox" class="usercheck" value="'.$value->users_id.'" name="associateid[]" id="associateid[]" style="height: 15px;width: 15px;" checked>
                                     </td><td>';
                }
                else
                {
                    if(isset($selectedUser))
                    {
                        if(in_array($value->users_id, $selectedUser))
                        {
                            $appendtd .= ' <tr class="content">
                                     <td><input type="checkbox" class="usercheck" value="'.$value->users_id.'" name="associateid[]" id="associateid[]" style="height: 15px;width: 15px;" checked>
                                     </td><td>';
                        }
                        else{
                        $appendtd .= ' <tr class="content">
                                    <td><input type="checkbox" class="usercheck" value="'.$value->users_id.'" name="associateid[]" id="associateid[]" style="height: 15px;width: 15px;"></td><td>';
                        }  
                    }
                    else
                    {
                        $appendtd .= ' <tr class="content">
                                    <td><input type="checkbox" class="usercheck" value="'.$value->users_id.'" name="associateid[]" id="associateid[]" style="height: 15px;width: 15px;">
                                    </td>
                                    <td>';
                    }
                }
                $imagepath = asset("/img/users/" . $value->users_profile_image); 
                $appendtd .= '<img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "'.$imagepath.'" /></td>
                    <td style="text-align: left;color: #11121380;font-size: 15px;">
                    '.ucfirst($value->users_name).'&nbsp'.ucfirst($value->last_name).'</td>
                    <td style="text-align: left;color: #11121380;font-size: 15px;">'.$value->users_company.'</td><td style="text-align: left;color: #11121380;font-size: 15px;">'.$value->users_email.'<br>
                       '.$value->users_phone.'
                    </td>
                  </tr>';
            }
        }
        return response()->json($appendtd);
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store project details
    public function store(Request $request)
    {
        $project = new Project;
        $project->project_name = $request->input('projectname');
        $project->project_site_address = $request->input('siteaddress');
        $project->milesrange = $request->input('milesrange');
        $project->latitude = $request->input('latitude');
        $project->longitude = $request->input('longitude');
        $reportdate = (string)$request->input('reportdate');
        $reportdate = new DateTime;
        $reportdate = $reportdate->format('Y-m-d H:i:s');
        $scope = $request['scopeperformedid'];
        $scope = implode (",",$scope);
        $associatetypeid = $request['associatetypeid'];
        $associatetypeid = implode (",",$associatetypeid);
        $projectname = $request->input('projectname');
        $address = $request->input('siteaddress');
        /*return response()->json(['success'=> $associatetypeid]);
        exit;*/
        if($request->input('onsitedate') != null)
        {
            $onsitedate = (string)$request->input('onsitedate');
            $onsitedate = date("Y-m-d H:i:s", strtotime($onsitedate));
            $project->on_site_date = $onsitedate;
        }
        if($request->input('instruction') != null)
        {
            $project->instructions = $request->input('instruction');
        }
        $footage_txt   = (string)$request->input('footage_txt');
        $footage       = str_replace( ',', '', $footage_txt );
        $projectbid    = (string)$request->input('projectbid');
        $projectbid    = str_replace( ',', '', $projectbid );
        $budget        = (string)$request->input('budget_txt');
        $budget        = str_replace( ',', '', $budget );
        $project->report_due_date = $reportdate;
        $latitude    = $request->input('latitude');
        $longitude   = $request->input('longitude');
        $project->report_template = $request->input('template');
        $project->approx_bid = (double)$projectbid;
        $project->scope_performed_id = $scope;
        $project->user_id = (int)$request->input('managerid');
        $project->property_type = $request->input('projectType');
        $project->no_of_units = $request->input('units_txt');
        $project->squareFootage = (double)$footage;
        $project->no_of_buildings = $request->input('building_txt');
        $project->land_area = $request->input('area_txt');
        $project->no_of_stories = $request->input('stories_txt');
        $project->year_built = $request->input('built_txt');
        $project->budget = (double)$budget;
        $project->employee_type_id = $associatetypeid;
        $project->created_by = 2;
        $temp = $this->getaddress($latitude,$longitude);
        $project->city    = $temp['city'];
        $project->state   = $temp['state'];
        $project->country = $temp['country'];
        $project->save();
        $project = Project::where('project_name','=',$projectname)
                            ->where('project_site_address','=',$address)
                            ->get();
        foreach($project as $value) 
        {
            $projectid = $value->project_id;
        }
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 1; //1 for project create status
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $touserid = $request->input('managerid');
        $notificationtext = 'New project assigned to you!';
        $notificationtype = '15';
        $fromuserid = session('loginuserid');
        $body = $request->input('projectname');
        $title = $notificationtext;
        $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
         //get associate type
        
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $miles = (int)$request->input('milesrange');
        //find nearest associate upto particuler distance
        $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                FROM users
                WHERE  user_types_id <>1
                AND users_approval_status <> 0
                AND associate_type_id IN ($associatetypeid)
                HAVING distance <= $miles"));
        //print_r($result);
       /* return response()->json(['success'=> $associatetypeid]);
        exit;*/
        if(!empty($result) && isset($result))
        {
            $notificationtext = 'New project listed in your area!';
            $notificationtype = '1'; //1 for create project
            $projectid = $projectid;
            $fromuserid = $request->input('managerid');
            $body = $request->input('projectname');
            $title = 'New project listed in your area!';
            $scope = explode(",",$scope);
            foreach($result as $value) 
            {
                $touserid = $value->users_id;
                $scope_Id = UserScopePerformed::where('users_id','=',$touserid)->first();
                if(isset($scope_Id) && !empty($scope_Id))
                {
                    $userScopeId = (string)$scope_Id->scope_performed_id;
                    $userScopeId = explode(",",$userScopeId);
                    $scopeflag = 1;
                    //check user scope performed is matches or not
                    foreach ($scope as $scopeid) {
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
                        $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                        $bidrequest = new ProjectBidRequest();
                        $bidrequest->project_id = $projectid;
                        $bidrequest->to_user_id = $touserid;
                        $bidrequest->from_user_id = $fromuserid;
                        $bidrequest->request_send_status = 1;
                        $bidrequest->created_at = date('Y-m-d H:i:s');
                        $bidrequest->save();
                    }
                }
            }
        }
        //send notification to selected users
        $associateid = $request['associate-ids'];
        if($associateid != 0)
        {
            $associateid = $request['associate-ids'];
            $associateid = explode(",",$associateid);
            $associateid = array_unique($associateid);
            foreach ($associateid as $touserid) {
                $bidrequest = ProjectBidRequest::where('to_user_id','=',$touserid)
                            ->where('project_id','=',$projectid)->first();
                if(!isset($bidrequest))
                {
                $notificationtext = 'New project listed in your area!';
                $notificationtype = '1'; //1 for create project
                $projectid = $projectid;
                $fromuserid = $request->input('managerid');
                $body = $request->input('projectname');
                $title = 'New project listed in your area!';
                $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                $bidrequest = new ProjectBidRequest();
                $bidrequest->project_id = $projectid;
                $bidrequest->to_user_id = $touserid;
                $bidrequest->from_user_id = $fromuserid;
                $bidrequest->request_send_status = 1;
                $bidrequest->created_at = date('Y-m-d H:i:s');
                $bidrequest->save();
                }

            }
        }
        
        return response()->json(['success'=>'Project created successfully']);
    }
    public function getaddress($latitude, $longitude)
    {
        $geolocation = $latitude.','.$longitude;
        $request     = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&latlng='.$geolocation.'&sensor=false'; 
        $file_contents = file_get_contents($request);
        $json_decode   = json_decode($file_contents);
        $city = $state = $country = '';
        if(isset($json_decode->results[0])) {
            $response = array();
            foreach($json_decode->results[0]->address_components as $addressComponet) {
                if(in_array('political', $addressComponet->types)) {
                        $response[] = $addressComponet->long_name; 
                }
            }
            $results = $json_decode->results[0]->address_components;
            $flag = 0;
            foreach ($results as $value) {
                if(in_array("administrative_area_level_1",$value->types))
                {
                    $state = $value->short_name;
                }
                if(in_array("locality",$value->types))
                {
                    $city = $value->short_name;
                    $flag = 1;
                }
                if($flag == 0)
                {
                    if(in_array("administrative_area_level_2",$value->types))
                    {
                        $city = $value->short_name;
                    }
                }
                if(in_array("country",$value->types))
                {
                    $country = $value->short_name;
                }
            }
            
        }
        $temp = array('state' => $state,'city' => $city,'country' => $country);
        return $temp;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $user = User::where('users_id','=',$id)->first();
        $username=$user->users_name;
        if($user->user_types_id == 1) //1 for scheduler
        {
            $projects = Project::where('user_id','=',$id)->get();
            if(isset($projects))
            {

                foreach ($projects as $value) 
                {
                    $projectid = $value->project_id;
                    $status = ProjectStatus::where('project_id','=',$projectid)
                                ->get();
                    foreach ($status as $projectstatus) 
                    {
                        //get project current status
                        $status1 = $projectstatus->project_status_type_id;
                    }
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                                        ->where('project_bid_status','=',1)
                                        ->where('bid_status','=',1)->first();
                    //1 for accept bid and project is allocated
                    if(isset($projectbid))
                    {
                        //final bid of project which is given by associate
                        $approx_bid = $projectbid->associate_suggested_bid;
                    }
                    else
                    {
                        //project suggested bid which is given by scheduler
                        $approx_bid = $value->approx_bid;
                    }
                    $userproject[] = ['project_name'       => $value->project_name, 
                                    'project_id'           => $value->project_id,
                                    'project_site_address' =>  $value->project_site_address,
                                    'report_due_date'      => $value->report_due_date,
                                    'report_template'      => $value->report_template,
                                    'scope_performed_id'   => $value->scope_performed_id,
                                    'instructions'         => $value->instructions,
                                    'approx_bid'           => number_format($value->approx_bid, 2),
                                    'created_at'           => $value->created_at,
                                    'status'               => $status1,
                                    'usertype'             => 1
                                    ];
                }
               
            }
            else
            {
                $userproject = null;
                $projectCount = 0;
            }
        }
        else
        {
            //else part execute when user type is associate
            $projects = DB::table('projects')
                        ->select('projects.project_id','projects.project_name','projects.user_id','projects.project_site_address','projects.report_due_date','projects.instructions','projects.approx_bid','projects.report_template','projects.scope_performed_id','projects.created_at','projects.updated_at','project_bids.associate_suggested_bid')
                        ->leftJoin('project_bids', 'projects.project_id', '=', 'project_bids.project_id')
                        ->where('project_bids.user_id','=',$id)
                        ->where('project_bids.project_bid_status','=',1)
                        ->get();
            if(isset($projects))
            {

                foreach ($projects as $value) 
                {
                    $projectid = $value->project_id;
                    $status = ProjectStatus::where('project_id','=',$projectid)
                                            ->get();
                    foreach ($status as $projectstatus) 
                    {
                        //get project current status
                        $status1 = $projectstatus->project_status_type_id;
                    }
                    $userproject[] = ['project_name'       => $value->project_name, 
                                    'project_id'           => $value->project_id,
                                    'project_site_address' =>  $value->project_site_address,
                                    'report_due_date'      => $value->report_due_date,
                                    'report_template'      => $value->report_template,
                                    'scope_performed_id'   => $value->scope_performed_id,
                                    'instructions'         => $value->instructions,
                                    'approx_bid'           => number_format($value->associate_suggested_bid, 2),
                                    'created_at'           => $value->created_at,
                                    'status'               => $status1,
                                    'usertype'             => 2
                                    ];
                }
               
            }
            else
            {
                $userproject = null;
                $projectCount = 0;
            }
        }

        if(!isset($userproject))
        {
            $userproject = null;
            $projectCount = 0;
        }
        else
        {
            $projectCount = count($userproject);
        }
        $scopeperformed= ScopePerformed::all();
        return view('project.index',[
                    'projects'       => $userproject, 
                    'user'           => $username,
                    'scopeperformed' => $scopeperformed,
                    'projectCount'   => $projectCount,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get all project details
        $project = Project::where('project_id','=',$id)->first();
        $scope   = ScopePerformed::all();
        $setting = Setting::where('setting_status','=',1)->first();
        if(isset($setting))
        {
            $minvalue = (string)$setting->min_miles;
            $maxvalue = (string)$setting->max_miles;
        }
        else
        {
            $minvalue = 0;
            $maxvalue = 0;
        }
        $date2      = date($project->report_due_date);
        $datetime2  = new DateTime($date2);
        $reportdate = $datetime2->format("m/d/Y");
        if(isset($project->on_site_date))
        {
            $date2      = date($project->on_site_date);
            $datetime2  = new DateTime($date2);
            $onsitedate = $datetime2->format("m/d/Y");    
        }
        else
        {
            $onsitedate = '   -';
        }
        $associatetype = AssociateType::all();
        return view('project.edit',[
                    'scope'         => $scope, 
                    'project'       => $project,
                    'minvalue'      => $minvalue,
                    'maxvalue'      => $maxvalue,
                    'reportdate'    => $reportdate,
                    'onsitedate'    => $onsitedate,
                    'associatetype' => $associatetype
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update project details
        $projectid = $id;
        $project_name = $request->input('projectname');
        $project_site_address = $request->input('siteaddress');
        $milesrange = $request->input('milesrange');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $reportdate = (string)$request->input('reportdate');
        $reportdate = date("Y-m-d H:i:s", strtotime($reportdate) );
        $scope = $request['scopeperformedid'];
        $scope = implode (",",$scope);
        $associatetypeid = $request['associatetypeid'];
        $associatetypeid = implode (",",$associatetypeid);
        if($request->input('onsitedate') != null)
        {
            $onsitedate = (string)$request->input('onsitedate');
            $onsitedate = date("Y-m-d H:i:s", strtotime($onsitedate));
            
        }
        else
        {
            $onsitedate = null;
        }
       
        if($request->input('instruction') != null)
        {
            $instructions = $request->input('instruction');
        }
        else
        {
            $instructions = null;
        }
        $temp    = $this->getaddress($latitude,$longitude);
        $city    = $temp['city'];
        $state   = $temp['state'];
        $country = $temp['country'];
        $report_template   = $request->input('template');
        $approx_bid        = (string)$request->input('projectbid');
        $approx_bid        = str_replace( ',', '', $approx_bid );
        $property_type     = $request->input('projectType');
        $no_of_units       = $request->input('units_txt');
        $squareFootage     = (string)$request->input('footage_txt');
        $squareFootage     = str_replace( ',', '', $squareFootage );
        $no_of_buildings   = $request->input('building_txt');
        $land_area         = $request->input('area_txt');
        $no_of_stories     = $request->input('stories_txt');
        $year_built        = $request->input('built_txt');
        $budget            = (string)$request->input('budget_txt');
        $budget            = str_replace( ',', '', $budget );
        $project = Project::where('project_id', '=', $projectid)
                    ->update(['project_name'       => $project_name,
                            'project_site_address' => $project_site_address,
                            'milesrange'           => $milesrange,
                            'latitude'             => $latitude,
                            'longitude'            => $longitude,
                            'city'                 => $city,
                            'country'              => $country,
                            'state'                => $state,
                            'report_due_date'      => $reportdate,
                            'on_site_date'         => $onsitedate,
                            'report_template'      => $report_template,
                            'instructions'         => $instructions,
                            'approx_bid'           => (double)$approx_bid,
                            'scope_performed_id'   => $scope,
                            'employee_type_id'     => $associatetypeid,
                            'property_type'        => $property_type,
                            'no_of_units'          => $no_of_units,
                            'squareFootage'        => (double)$squareFootage,
                            'no_of_buildings'      => $no_of_buildings,
                            'land_area'            => $land_area,
                            'no_of_stories'        => $no_of_stories,
                            'year_built'           => $year_built,
                            'budget'               => (double)$budget
                            ]);
        
        if($project != 0)
        {
            $project = Project::where('project_id','=',$projectid)->first();
            $userid = $project->user_id;
            $notificationtext = 'Scheduler updated project details';
            $notificationtype = '6';
            $fromuserid = session('loginuserid');
            $touserid = $userid;
            $body = $request->input('projectname');
            $title = 'Scheduler updated project details';
            $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,
                                        $notificationtext,$notificationtype);
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $miles = (int)$request->input('milesrange');
            //find nearby associates to send paroject available notification
            $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                FROM users
                WHERE  user_types_id <>1
                AND users_approval_status <> 0 
                AND associate_type_id IN ($associatetypeid)
                HAVING distance <= $miles"));
            
            $bidrequeststatus = ProjectBidRequest::where('project_id', '=', $projectid)
                                                  ->update(['bid_request_status' => 1]);
            $scope = explode(",",$scope);
            if(!empty($result) && isset($result))
            {
                foreach($result as $value) 
                {
                    $touserid = $value->users_id;
                    $scope_Id = UserScopePerformed::where('users_id','=',$touserid)->first();
                    $userScopeId = (string)$scope_Id->scope_performed_id;
                    $userScopeId = explode(",",$userScopeId);
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
                        $bidrequest = ProjectBidRequest::where('to_user_id','=',$touserid)
                                                        ->where('project_id','=',$projectid)
                                                        ->first();
                        if(isset($bidrequest) && !empty($bidrequest))
                        {
                            $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                            $bidrequeststatus = ProjectBidRequest::where('project_id', '=', $projectid)->where('to_user_id','=',$touserid)->update(['bid_request_status' => 0]);
                        }
                        else
                        {
                            $notificationtext = 'New project listed in your area!';
                            $notificationtype = '1';
                            $title = $notificationtext;
                            $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                            $bidrequest = new ProjectBidRequest();
                            $bidrequest->project_id = $projectid;
                            $bidrequest->to_user_id = $touserid;
                            $bidrequest->from_user_id = $fromuserid;
                            $bidrequest->request_send_status = 1;
                            $bidrequest->created_at = date('Y-m-d H:i:s');
                            $bidrequest->save();
                        }
                    }

                }
            }
            //send notification to selected users
            //$associateid = $request['associate-ids'];
            if(!empty($request['associate-ids']))
            {
                $associateid = $request['associate-ids'];
                $associateid = explode(",",$associateid);
                $associateid = array_unique($associateid);
                foreach ($associateid as $touserid) {
                    $bidrequest = ProjectBidRequest::where('to_user_id','=',$touserid)
                            ->where('project_id','=',$projectid)->first();
                    if(!isset($bidrequest))
                    {

                        $notificationtext = 'New project listed in your area!';
                        $notificationtype = '1';
                        $title = $notificationtext;
                        $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
                        $bidrequest = new ProjectBidRequest();
                        $bidrequest->project_id = $projectid;
                        $bidrequest->to_user_id = $touserid;
                        $bidrequest->from_user_id = $fromuserid;
                        $bidrequest->request_send_status = 1;
                        $bidrequest->created_at = date('Y-m-d H:i:s');
                        $bidrequest->save();
                    }
                    else
                    {
                        if($bidrequest->bid_request_status == 1)
                        {
                            $notificationtext = 'Scheduler updated project details';
                            $notificationtype = '6';
                            $title = $notificationtext;
                            $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);

                            $bidrequeststatus = ProjectBidRequest::where('project_id', '=', $projectid)
                                ->where('to_user_id','=',$touserid)->update(['bid_request_status' => 0]);

                        }
                    }

                }
            }
            $bidrequest = ProjectBidRequest::where('project_id','=',$projectid)
                          ->where('bid_request_status','=',1)->delete();
           
            return response()->json(['success'=>'Project updated successfully']);
        }
        else
        {
            return response()->json(['success'=>'Projectis not updated']);
        }
        
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
    public function settings()
    {
        return view('settings.setsetting');
    }
    public function changesetting(Request $request)
    {
       $minmiles = $request['minmiles'];
       $maxmiles = $request['maxmiles'];
       $model = Setting::where('setting_status','=', 1)
       ->update(['setting_status' => 0]);
       $setting = new Setting;
       $setting->min_miles = $minmiles;
       $setting->max_miles = $maxmiles;
       $setting->setting_status = 1;
       $setting->created_at = date('Y-m-d H:i:s');
       $setting->save();
       $msg = 'Setting changed successfully';
        return Response::json($msg);
    }
    public function showprojects()
    {
         /* allocated projects*/
       $projects = ProjectBid::where('project_bid_status','=',1)
                    ->orderBy('project_bid_id','desc')->get();
       if(isset($projects))
       {
            foreach ($projects as $value) 
            {
            $projectid = $value->project_id;
            $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                            ->get();
            foreach ($projectstatus as $status) 
            {
                $status1 = $status->project_status_type_id;
            }
            if($status1 == 3 or $status1 == 2)
            {
                $project = Project::where('project_id','=',$projectid)
                ->first();
                $manager = User::where('users_id','=',$project->user_id)->first();
                $managername = $manager->users_name.' '.$manager->last_name;
                $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                $associatename = User::where('users_id','=',$value->user_id)
                ->first();
                $associateName = $associatename->users_name.' '.$associatename->last_name;
                $data[] = ['project_name'          => $project->project_name, 
                            'project_id'           => $project->project_id,
                            'project_site_address' =>  $project->project_site_address,
                            'instructions'         => $project->instructions,
                            'approx_bid'           => number_format($value->associate_suggested_bid, 2),
                            'associatename'        => $associateName,
                            'created_at'           => $project->created_at,
                            'statuscount'          => $statuscount,
                            'managername'          => $managername
                ];
            }
        }
            if(!isset($data))
            {
                $data = null;

            }
        }
        else
        {
            $data = null;

        }
        /* Completed projects*/
        $projects = DB::table('projects')
                        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('project_status_type_id','=',4)
                        ->orderBy('project_status.project_status_id','desc')
                        ->get();
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
            ->where('project_bid_status','=', 1)->first();
            $associatename = User::where('users_id','=',$projectbid->user_id)
            ->first();
            $associateName = $associatename->users_name.' '.$associatename->last_name;
            $manager = User::where('users_id','=',$value->user_id)->first();
           
            $managername = $manager->users_name.' '.$manager->last_name;
            $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',4)->first();
            $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
            $completedproject[] = ['project_name'          => $value->project_name,
                                    'project_id'           => $value->project_id,
                                    'project_site_address' =>  $value->project_site_address,
                                    'approx_bid'           => number_format($projectbid->associate_suggested_bid, 2),
                                    'associatename'        => $associateName,
                                    'created_at'           => $value->created_at,
                                    'completeddate'        => $status->created_at,
                                    'statuscount'          => $statuscount,
                                    'managername'          => $managername
                                   ];
        }
        /* Cancelled  projects*/
        $projects = DB::table('projects')
                    ->select('projects.project_name','projects.project_id','projects.project_site_address','projects.report_due_date','projects.report_template','projects.scope_performed_id','projects.instructions','projects.created_at','projects.user_id')
                    ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                    ->where('project_status_type_id','=',5)
                    ->orderBy('project_status.project_status_id','desc')
                    ->get();
       
        foreach($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
            ->where('project_bid_status','=', 1)->first();
            $associatename = User::where('users_id','=',$projectbid->user_id)
            ->first();
            $associateName = $associatename->users_name.' '.$associatename->last_name;
            $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',5)->first();
            $manager = User::where('users_id','=',$value->user_id)->first();
            $managername = $manager->users_name.' '.$manager->last_name;
            
            $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
            $cancelledproject[] = ['project_name'     => $value->project_name, 
                                'project_id'          => $value->project_id,
                                'project_site_address'=>  $value->project_site_address,
                                'createddate'         => $value->created_at,
                                'approx_bid'          => number_format($projectbid->associate_suggested_bid, 2),
                                'associatename'       => $associateName,
                                'cancelleddate'       => $status->created_at,
                                'statuscount'         => $statuscount,
                                'managername'         => $managername
                                ];

        }
         /* non allocated projects*/
        $projects = Project::orderBy('project_id','desc')->get();
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)->
                        where('project_bid_status','=',1)->first();
            $bidcount = ProjectBid::where('project_id','=',$projectid)
                                    ->where('project_bid_status','=',2)
                                    ->where('bid_status','=',1)->count();
            $createdBy = $value->created_by;
            $projectStatus = ProjectStatus::where('project_status_type_id','=',1)
                                            ->where('project_id','=',$projectid)->first();
            if(!isset($projectbid) && isset($projectStatus))
            {
                $managerid = $value->user_id;
                $user = User::where('users_id','=',$managerid)->first();
               
                $managername = $user->users_name.' '.$user->last_name;
                    //newly created projects
                    $nonallocatedproject[] = ['project_name' => $value->project_name, 
                            'project_id'           => $value->project_id,
                            'project_site_address' =>  $value['project_site_address'],
                            'approx_bid'           => number_format($value->approx_bid, 2),
                            'managername'          => $managername,
                            'created_at'           => $value->created_at,
                            'bidcount'             => $bidcount,
                            'createdBy'            => $createdBy
                            ];
            }
           
        }

        /* Onhold projects */
        $projects = DB::table('projects')
         ->select('projects.project_name','projects.project_id','projects.project_site_address','projects.report_due_date','projects.report_template','projects.scope_performed_id','projects.instructions','projects.created_at','projects.user_id')
        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
        ->where('project_status_type_id','=',6)
        ->orderBy('project_status.project_status_id','desc')
        ->get();
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectstatus = ProjectStatus::where('project_id','=',$projectid)->get();
            foreach ($projectstatus as $status) 
            {
                $status1 = $status->project_status_type_id;
            }
            if($status1 == 6)
            {
                $projectbid = ProjectBid::where('project_id','=',$projectid)
                ->where('project_bid_status','=', 1)->first();
                $associatename = User::where('users_id','=',$projectbid->user_id)
                ->first();
                $associateName = $associatename->users_name.' '.$associatename->last_name;
                $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                $manager = User::where('users_id','=',$value->user_id)->first();
                $managername = $manager->users_name.' '.$manager->last_name;
                $onholdprojects[] = ['project_name' => $value->project_name, 
                            'project_id'            => $value->project_id,
                            'project_site_address'  =>  $value->project_site_address,
                            'createddate'           => $value->created_at,
                            'approx_bid'            => number_format($projectbid->associate_suggested_bid, 2),
                            'associatename'         => $associateName,
                            'statuscount'           => $statuscount,
                            'managername'           => $managername
                            ];
            }
            

        }
        if(!isset($completedproject))
        {
            $completedproject = null;
        }
        if(!isset($data))
        {
            $data = null;
        }
        if(!isset($cancelledproject))
        {
            $cancelledproject = null;
        }
        if(!isset($nonallocatedproject))
        {
            $nonallocatedproject = null;
        }
        if(!isset($onholdprojects))
        {
            $onholdprojects = null;
        }
        if(!isset($bidsproject))
        {
            $bidsproject = null;
        }
        /*$projectbid = ProjectBid::where('project_bid_status','=',1)->get();
        $projects = Project::where('user_id','=',$id)->paginate(8);*/
        $scopeperformed= ScopePerformed::all();
        return view('project.projects',[
                    'projects'           => $data, 
                    'scopeperformed'     => $scopeperformed,
                    'completedproject'   => $completedproject,
                    'cancelledproject'   => $cancelledproject,
                    'nonallocatedproject'=> $nonallocatedproject,
                    'onholdprojects'     => $onholdprojects
                ]);

    }
    //get all pending bids of specific projects
    public function projectbid($projectid)
    {
        $projectbid = ProjectBid::where('project_id','=',$projectid)
                    ->where('project_bid_status','=',2)
                    ->where('bid_status','=',1)
                    ->orderBy('associate_suggested_bid','desc')->get();
       
        //check project is allocated or not
        $bidaccept = ProjectBid::where('project_id','=',$projectid)
                    ->where('project_bid_status','=',1)
                    ->where('bid_status','=',1)->first();
        if(isset($bidaccept) && !empty($bidaccept))
        {
            /*$bidstatus = 1;
            $associateid = $bidaccept->user_id;
            $associate = User::where('users_id','=',$associateid)
                                ->first();
            if(isset($associate))
            {
                $project = Project::where('project_id','=',$projectid)->first();
                $projectname = $project->project_name;
                $associatename = $associate->users_name;
                $data[] = ['associatename'    => $associatename, 
                               'associateid'  => $bidaccept->user_id,
                               'projectid'    => $projectid,
                               'associatebid' =>  number_format($bidaccept->associate_suggested_bid,2),
                               'suggestedbid' => number_format($project->approx_bid, 2),
                               'createddate'  => $bidaccept->created_at
                               ];
                return view('project.viewbids',[
                    'bids'        => $data, 
                    'projectname' => $projectname,
                    'bidstatus'   => $bidstatus

                ]);
                exit;
            }*/
                
        }
        else
        {
            $bidstatus = 0;
        }
        $project = Project::where('project_id','=',$projectid)->first();
        $projectname = $project->project_name;
        if(isset($projectbid) && !empty($projectbid))
        {
           
            foreach ($projectbid as $value) 
            {
                $associateid = $value->user_id;

                $associate = User::where('users_id','=',$associateid)
                                    ->first();
                if(isset($associate))
                {
                    $associatename = $associate->users_name;
                    if($value->is_employee == 0)
                    {
                        $data[] = ['associatename'=> $associatename, 
                               'associateid'  => $value->user_id,
                               'projectid'    => $projectid,
                               'associatebid' =>  number_format($value->associate_suggested_bid,2),
                               'suggestedbid' => number_format($project->approx_bid, 2),
                               'createddate'  => $value->created_at
                               ];
                    }
                    else
                    {
                        $employee[] = ['associatename'=> $associatename, 
                               'associateid'  => $value->user_id,
                               'projectid'    => $projectid,
                               'suggestedbid' => number_format($project->approx_bid, 2),
                               'createddate'  => $value->created_at
                               ];
                    }
                    
                }
            }
            if(!isset($data) && empty($data))
            {
                $data = '';
                $bidCount = 0;
            }
            else
            {
                $bidCount = count($data);
            }
            if(!isset($employee) && empty($employee))
            {
                $employee = '';
                $employeeCount = 0;
            }
            else
            {
                $employeeCount = count($employee);
            }
            return view('project.viewbids',[
                    'bids'          => $data, 
                    'projectname'   => $projectname,
                    'bidstatus'     => $bidstatus,
                    'employee'      => $employee,
                    'bidCount'      => $bidCount,
                    'employeeCount' => $employeeCount
                ]);
            exit;
        }
        else
        {
            return view('project.viewbids',[
                
                    'projectname' => $projectname,
            ]);
        }
    }
    
   //get pending bids for dashboard 
    //get all pending bids of specific projects
    public function pendingBids($projectid)
    {
        $projectbid = ProjectBid::where('project_id','=',$projectid)
                    ->where(['project_bid_status' => 2,'bid_status' => 1])
                    ->orderBy('associate_suggested_bid','desc')->get();
        $project = Project::where('project_id','=',$projectid)->first();
        $projectname = $project->project_name;
        if(isset($projectbid) && !empty($projectbid))
        {
            foreach ($projectbid as $value) 
            {
                $associateid = $value->user_id;
                $associate = User::where('users_id','=',$associateid)
                                   ->first();
                if(isset($associate))
                {
                    $associatename = $associate->users_name.' '.$associate->last_name;
                    if($value->is_employee == 0)
                    {
                        $data[] = ['associatename'=> $associatename, 
                               'associateid'  => $value->user_id,
                               'projectid'    => $projectid,
                               'associatebid' => number_format($value->associate_suggested_bid,2),
                               'suggestedbid' => number_format($project->approx_bid, 2),
                               'createddate'  => $value->created_at
                               ];
                    }
                    else
                    {
                        $employee[] = ['associatename'=> $associatename, 
                               'associateid'  => $value->user_id,
                               'projectid'    => $projectid,
                               'suggestedbid' => number_format($project->approx_bid, 2),
                               'createddate'  => $value->created_at
                               ];
                    }
                    
                }
            }

            if(!isset($data) && empty($data))
            {
                $data = null;
                $bidCount = 0;
            }
            else
            {
                $bidCount = count($data);
            }
            if(!isset($employee) && empty($employee))
            {
                $employee = null;
                $employeeCount = 0;
            }
            else
            {
                $employeeCount = count($employee);
            }
            return view('project.pendingBids',[
                    'bids'          => $data, 
                    'employee'      => $employee,
                    'projectname'   => $projectname,
                    'bidCount'      => $bidCount,
                    'employeeCount' => $employeeCount
                ]);
            exit;
        }
        else
        {
            return view('project.pendingBids',[
                
                    'projectname' => $projectname,
            ]);
        }
    }
    public function bidaccept($projectid,$userid,$status)
    {
     
        $flag = $this->projectBidAccept($projectid,$userid,$status);
        if($flag == 0)
        {
            session()->flash('message', 'Bid Rejected successfully!');
            return redirect()->action('UserController@dashboard');
        }
        else
        {
            session()->flash('message', 'Bid accepted successfully!');
            return redirect()->action('UserController@dashboard');
        }
            
        
        
    } 
   public function pushnotification($deviceid,$title,$body,$notificationid,$dataid,$notificationcount,$devicetype)
    {
        //device type 2 for android

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
        //devicetype 1 for ios
        if($devicetype == 1)
        {
            $feedback = PushNotification::setService('fcm')
                    ->setMessage([
                                'notification' => [
                                    'title'             => $title,
                                    'body'              => $body,
                                    'notificationid'    => $notificationid,
                                    'dataid'            => $dataid,
                                    'notificationcount' => $notificationcount
                                            ]
                                ])
                    ->setApiKey('AAAANdKrzEQ:APA91bHZB_ZC2PomiZ2zjIfcDRF219E7hT29sMX1X9Bi3kCNDfHEY-PZ0vlih6O4_trRs_iUUwOh-edlDGKAjSQYEM74wLhq88bLPLzra6jiRvHvSd_EWsBNza86YnmLoP1Db-hBCrtN')
                    ->setDevicesToken([$deviceid])
                    ->send()
                    ->getFeedback();
        }
        

    }
    public function setaddress(Request $request)
    {

        return view('project.map');
    }
    public function sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype)
    {
        //store notification details
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
       
        /* find that devices where user is login*/
        $accesskey = UserAccessKey::where('user_id','=',$touserid)
                                    ->where('user_access_key_status','=',1)->get();
        
        $projectid = (string)$projectid;
        //count for check how many notifications are not reading by user
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
            //1 for received notificaion setting is on
            if($user->notification_enable == 1)
            {
                $this->pushnotification($devicetokenid,$title,$body,$notificationid,$projectid,$notificationcount,$devicetype);
            }
            
        }
    }
    //show manager projects
    public function managerprojects(Request $request)
    {
        /*allocated projects */
        /*$pagenumber = $request['pagenumber'];
        $limit = 6;*/
        $userid = session('loginuserid');
        $projects = Project::where('user_id','=',$userid)
                    ->orderBy('project_id','desc')->get();
        $count = $projects->count();
        if($count != 0)
        {
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)->get();
                foreach ($projectstatus as $status) 
                {
                   $status1 = $status->project_status_type_id;
                }
                if($status1 == 3)
                {
                    //get project bid details
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                    ->where('project_bid_status','=', 1)->first();
                    $associatename = User::where('users_id','=',$projectbid->user_id)
                    ->first();
                    $associateName = $associatename->users_name.' '.$associatename->last_name;
                    $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                    $data[] = ['project_name'        => $value->project_name, 
                              'project_id'           => $value->project_id,
                              'project_site_address' =>  $value->project_site_address,
                              'report_due_date'      => $value->report_due_date,
                              'report_template'      => $value->report_template,
                              'scope_performed_id'   => $value->scope_performed_id,
                              'instructions'         => $value->instructions,
                              'created_at'           => $value->created_at,
                              'approx_bid'           => number_format($projectbid->associate_suggested_bid, 2),
                              'associatename'        => $associateName,
                              'statuscount'          => $statuscount
                              ];
                }
                
            }
        }
        
        /* Completed projects*/
        $projects = DB::table('projects')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS projects.project_id'),'projects.project_id','projects.project_name','projects.user_id','projects.project_site_address','projects.on_site_date','projects.report_due_date','projects.instructions','projects.approx_bid','projects.report_template','projects.scope_performed_id','projects.created_at','projects.updated_at','project_status.project_status_type_id')
                        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('projects.user_id','=',$userid)
                        ->where('project_status.project_status_type_id','=',4)
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->get();  
        $count = $projects->count();
        if($count != 0)
        { 
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;
                $projectbid = ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=', 1)->first();
                $associatename = User::where('users_id','=',$projectbid->user_id)
                                ->first();
                $associateName = $associatename->users_name.' '.$associatename->last_name;
                $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',4)->first();
                $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                $completedproject[] = ['project_name' => $value->project_name,
                                        'project_id' => $value->project_id,
                                        'project_site_address' =>  $value->project_site_address,
                                        'report_due_date' => $value->report_due_date,
                                        'report_template' => $value->report_template,
                                        'scope_performed_id' => $value->scope_performed_id,
                                        'instructions' => $value->instructions,
                                        'approx_bid' => number_format($projectbid->associate_suggested_bid, 2),
                                        'associatename' => $associateName,
                                        'created_at' => $value->created_at,
                                        'completeddate' => $status->created_at,
                                        'statuscount'   => $statuscount
                                        ];
            }
        }
             /* Cancelled  projects*/
            $projects = DB::table('projects')
                        ->select(DB::raw('SQL_CALC_FOUND_ROWS projects.project_id'),'projects.project_id','projects.project_name','projects.user_id','projects.project_site_address','projects.on_site_date','projects.report_due_date','projects.instructions','projects.approx_bid','projects.report_template','projects.scope_performed_id','projects.created_at','projects.updated_at','project_status.project_status_type_id')
                        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
                        ->where('projects.user_id','=',$userid)
                        ->where('project_status.project_status_type_id','=',5)
                        ->orderBy('project_status.project_status_id', 'desc')
                        ->get();   
            $count = $projects->count();
            if($count != 0)
            {
                foreach ($projects as $value) 
                {
                    $projectid = $value->project_id;
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                                ->where('project_bid_status','=', 1)->first();
                    $associatename = User::where('users_id','=',$projectbid->user_id)
                                    ->first(); 
                    $associateName = $associatename->users_name.' '.$associatename->last_name;          
                    $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',5)->first();
                    $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                    $cancelledproject[] = ['project_name' => $value->project_name, 
                                        'project_id'  => $value->project_id,
                                        'project_site_address' =>  $value->project_site_address,
                                        'report_due_date' => $value->report_due_date,
                                        'report_template' => $value->report_template,
                                        'scope_performed_id' => $value->scope_performed_id,
                                        'instructions' => $value->instructions,
                                        'createddate' => $value->created_at,
                                        'approx_bid' =>  number_format($projectbid->associate_suggested_bid, 2),

                                        'associatename' => $associateName,
                                        'cancelleddate' => $status->created_at,
                                        'statuscount'   => $statuscount
                                        ];

                }
            }
         /* non allocated projects*/

        $projects = Project::where('user_id','=',$userid)
                            ->orderBy('project_id','desc')->get();
        $count = $projects->count();
        if($count != 0)
        {
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;

                $projectbid = ProjectBid::where('project_id','=',$projectid)->
                        where('project_bid_status','=',1)->first();
                $bidcount = ProjectBid::where('project_id','=',$projectid)
                                    ->where('project_bid_status','=',2)
                                    ->where('bid_status','=',1)->count();
                
                if(!isset($projectbid))
                {
                    $managerid = $value->user_id;
                    $user = User::where('users_id','=',$managerid)->first();
                    $managername = $user->users_name;
                    $nonallocatedproject[] =['project_name' => $value->project_name, 
                                            'project_id' => $value->project_id,
                                            'project_site_address' =>  $value['project_site_address'],
                                            'report_due_date' => $value->report_due_date,
                                            'report_template' => $value->report_template,
                                            'scope_performed_id' => $value->scope_performed_id,
                                            'instructions' => $value->instructions,
                                            'approx_bid' => number_format($value->approx_bid, 2),
                                            'managername' => $managername,
                                            'created_at' => $value->created_at,
                                            'updated_at' => $value->updated_at,
                                            'bidcount'   => $bidcount,
                                            'createdBy'  => $value->created_by
                                            ];
                }
            }
        }

        /* onhold project for project manager */
        $projects = Project::where('user_id','=',$userid)
                            ->orderBy('project_id','desc')->get();
        $count = $projects->count();
        if($count != 0)
        {
            foreach ($projects as $value) 
            {
                $projectid = $value->project_id;
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)->get();
                foreach ($projectstatus as $status) 
                {
                   $status1 = $status->project_status_type_id;
                }
                if($status1 == 6)
                {
                    $projectbid = ProjectBid::where('project_id','=',$projectid)
                    ->where('project_bid_status','=', 1)->first();
                    $associatename = User::where('users_id','=',$projectbid->user_id)
                    ->first();
                    $associateName = $associatename->users_name.' '.$associatename->last_name;
                    $statuscount = ProjectProgressStatus::where('project_id','=',$projectid)->count();
                    $onholdprojects[] = ['project_name' => $value->project_name, 
                                        'project_id'  => $value->project_id,
                                        'project_site_address' =>  $value->project_site_address,
                                        'report_due_date' => $value->report_due_date,
                                        'report_template' => $value->report_template,
                                        'scope_performed_id' => $value->scope_performed_id,
                                        'instructions' => $value->instructions,
                                        'createddate' => $value->created_at,
                                        'approx_bid' => number_format($projectbid->associate_suggested_bid, 2),
                                        'associatename' => $associateName,
                                        'statuscount'   => $statuscount
                                        ];
                }
                
            }
        }
        
        if(!isset($completedproject))
        {
            $completedproject = null;
        }
        if(!isset($data))
        {
            $data = null;
        }
        if(!isset($cancelledproject))
        {
            $cancelledproject = null;
        }
        if(!isset($nonallocatedproject))
        {
            $nonallocatedproject = null;
        }
        if(!isset($onholdprojects))
        {
            $onholdprojects = null;
        }

        $scopeperformed= ScopePerformed::all();
        return view('project.projects',[
                    'projects'      => $data, 
                    'scopeperformed'=> $scopeperformed,
                    'completedproject' => $completedproject,
                    'cancelledproject' => $cancelledproject,
                    'nonallocatedproject' => $nonallocatedproject,
                    'onholdprojects'     => $onholdprojects
                ]);


    }
    public function bidacceptreject($projectid,$userid,$status)
    {
        $flag = $this->projectBidAccept($projectid,$userid,$status);
        if($flag == 0)
        {
            session()->flash('message', 'Bid Rejected successfully!');
            return redirect()->route('allProjects');
        }
        else
        {
            session()->flash('message', 'Bid accepted successfully!');
            return redirect()->route('allProjects');
        }
        
       
        
    }
    public function projectBidAccept($projectid,$userid,$status)
    {
        $adminid = session('loginuserid');
        $date    = date("Y-m-d H:i:s");
        $user = User::where('users_id','=',$userid)->first();
        if($status == 0)
        {
            ProjectBid::where('user_id','=', $userid)
                        ->where('project_id','=',$projectid)
                        ->where('project_bid_status','=',2)
                        ->where('bid_status','=',1)
                        ->update(['project_bid_status' => $status,
                                'accepted_rejected_at' => $date]);
            if($user->associate_type_id == 1)
            {
                $notificationtext = 'Sorry! Your request was rejected!';
            }
            else
            {
                $notificationtext = 'Sorry! Your bid was rejected!';
            }
            $project = Project::where('project_id','=',$projectid)->first();
            $body    = $project->project_name;
            $title   = $notificationtext;
            $notificationid = '4';
            $this->sendUserNotification($userid,$adminid,$projectid,$body,$title,$notificationtext,$notificationid);
            return 0;
        }
        else
        {
            $rejectuserbid = ProjectBid::where('user_id','<>', $userid)
                            ->where('project_id','=',$projectid)
                            ->where('bid_status','=',1)
                            ->where('project_bid_status','=',2)
                            ->get();
            ProjectBid::where('user_id','=', $userid)
                            ->where('project_id','=',$projectid)
                            ->where('bid_status','=',1)
                            ->where('project_bid_status','=',2)
                            ->update(['project_bid_status' => 1,'accepted_rejected_at' => $date]);
            ProjectBid::where('project_id','=',$projectid)
                            ->where('project_bid_status','=',2)
                            ->where('bid_status','=',1)
                            ->update(['project_bid_status' => 0,'accepted_rejected_at' => $date]);
            
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
            $fromuserid = session('loginuserid');
            $project = Project::where('project_id','=',$projectid)->first();
            $managerid = $project->user_id;
            $body = $project->project_name;
            $projectid = (string)$projectid;
            $title = 'Job is allocated to '.$user->users_name;
            $msg = $title;
            $notificationid = '3';
            $this->sendUserNotification($managerid,$adminid,$projectid,$body,$title,$msg,$notificationid);
            if(isset($rejectuserbid) && !empty($rejectuserbid))
            {
                $msg = $title;
                $notificationid = '4';
                foreach ($rejectuserbid as $value) {
                    $rejectUserid = $value->user_id;
                    $associate = User::where('users_id','=',$rejectUserid)->first();
                    if($associate->associate_type_id == 1)
                    {
                        $title = 'Sorry! Your request was rejected!';
                    }
                    else
                    {
                        $title = 'Sorry! Your bid was rejected!';
                    }
                    $this->sendUserNotification($rejectUserid,$managerid,$projectid,$body,$title,$msg,$notificationid);
                }
            }
            if($user->associate_type_id == 1)
            {
                $title = 'Congratulations! Your request was accepted!';
            }
            else
            {
                $title = 'Congratulations! Your bid was accepted!';
            }
            $msg = $title;
            $notificationid = '3';
            $this->sendUserNotification($userid,$managerid,$projectid,$body,$title,$msg,$notificationid);
            return 1;
    }
}
    //show project details
    public function projectDetail($id)
    {
        $project = Project::where('project_id','=',$id)->first();
        $projectStatus = ProjectStatus::where('project_id','=',$id)->get();
        foreach ($projectStatus as $value) {
            $holdstatus = $value->project_status_type_id ;
        }

        $scope = ScopePerformed::all();
        $setting = Setting::where('setting_status','=',1)->first();
        if(isset($setting))
        {
            $minvalue = (string)$setting->min_miles;
            $maxvalue = (string)$setting->max_miles;
        }
        else
        {
            $minvalue = 0;
            $maxvalue = 0;
        }
        $date2= date($project->report_due_date);
        $datetime2 = new DateTime($date2);
        $reportdate= $datetime2->format("m/d/Y");
        if(!is_null($project->on_site_date))
        {
            $date2= date($project->on_site_date);
            $datetime2 = new DateTime($date2);
            $onsitedate= $datetime2->format("m/d/Y");    
        }
        else
        {
            $onsitedate= '   -';
        }
        if(!is_null($project->qaqc_date))
        {
            $qaqcDate = date($project->qaqc_date);
            $qaqcDate = new DateTime($qaqcDate);
            $qaqcDate = $qaqcDate->format("m/d/Y");    
        }
        else{
            $qaqcDate = '   -';
        }
        $projectbid = ProjectBid::where('project_id','=',$id)
                                ->where('project_bid_status','=',1)
                                ->first();
        
        if(isset($projectbid))
        {
            $finalbid = $projectbid->associate_suggested_bid;
            
            $users = User::where('users_id','=',$projectbid->user_id)->first();
            $associateTypeId = $users->associate_type_id;
            $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
            $user =  array('status'            => 1, 
                       'users_name'            => $users->users_name,
                       'last_name'             => $users->last_name,
                       'users_email'           => $users->users_email,
                       'users_company'         => $users->users_company,
                       'users_phone'           => $users->users_phone,
                       'users_profile_image'   => $users->users_profile_image,
                       'associateType'         => $associateType->associate_type,

                        );
            $statuscount = ProjectProgressStatus::where('project_id','=',$id)->count();
        }
        
        else
        {
            $finalbid = 0;
        }
        if(!isset($user))
        {
            $user = 0;
        }
        if(!isset($statuscount))
        {
            $statuscount = 0;
        }
        $associateType = AssociateType::all();
        return view('project.projectdetail',[
                    'scope'          => $scope, 
                    'project'        => $project,
                    'minvalue'       => $minvalue,
                    'maxvalue'       => $maxvalue,
                    'reportdate'     => $reportdate,
                    'onsitedate'     => $onsitedate,
                    'qaqcDate'       => $qaqcDate,
                    'finalbid'       => $finalbid,
                    'propertyType'   => $project->property_type,
                    'noOfUnits'      => (string)$project->no_of_units,
                    'noOfStories'    => (string)$project->no_of_stories,
                    'sqFootage'      => (string)$project->squareFootage,
                    'noBuildings'    => (string)$project->no_of_buildings,
                    'landArea'       => (string)$project->land_area,
                    'yearBuilt'      => (string)$project->year_built,
                    'user'           => $user,
                    'statuscount'    => $statuscount,
                    'holdstatus'     => $holdstatus,
                    'associateType'  => $associateType,

                ]);
    } 
    //project complete by manager
    /*public function projectComplete(Request $request)
    {
        $projectid = $request['projectid'];
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 4;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $userid = session('loginuserid');
        $touserid = $associate->user_id;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $msg = 'Project completed by manager!';
        $notificationid = '7';
        $title = $msg;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$msg,$notificationid);
        session()->flash('message', 'Project Completed Successfully!');
        $temp = array('status'  => 1,
                      'message' => 'Review submitted successfully'
                    );
        return response()->json($temp);
    }*/
    public function projectComplete($id)
    {
        $projectid = $id;
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 4;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $userid = session('loginuserid');
        $touserid = $associate->user_id;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $msg = 'Project completed by manager!';
        $notificationid = '7';
        $title = $msg;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$msg,$notificationid);
        session()->flash('message', 'Project Completed Successfully!');
        return redirect()->route('projectList');
    }

    //project cancel by manager
    public function projectCancel($id)
    {
        $projectid = $id;
        $model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id  = 5;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $userid = session('loginuserid');
        $touserid = $associate->user_id;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $msg = 'Project cancelled by manager!';
        $notificationid = '8';
        $title = $msg;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$msg,$notificationid);
        session()->flash('message', 'Project Cancelled Successfully!');
        return redirect()->route('projectList');
    }
    //project onhold by manager
    public function projectOnHold($id)
    {
        $projectid = $id;
        $projectbid = ProjectStatus::where('project_id','=',$projectid)
                                    ->where('project_status_type_id','=',3)
                                    ->update(['project_status_type_id' => 6]);
        $notificationid = '13';
        $msg = 'Project is On hold by manager!';
        $message = "Project On hold successfully!";
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $userid = session('loginuserid');
        $touserid = $associate->user_id;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $title = $msg;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$msg,$notificationid);
        session()->flash('message',$message);
        return redirect()->route('projectList');
    }
    //project in progress by manager
    public function projectInProgress($id)
    {
        $projectid = $id;
        $projectbid = ProjectStatus::where('project_id','=',$projectid)
                                            ->where('project_status_type_id','=',6)
                                            ->update(['project_status_type_id' => 3]);
        $notificationid = '14';
        $msg = 'Project is In progress by manager!';
        $message = "Project In progress successfully!";
        $associate= ProjectBid::where('project_id','=',$projectid)
                              ->where('project_bid_status','=',1)->first();
        $userid = session('loginuserid');
        $touserid = $associate->user_id;
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $title = $msg;
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$msg,$notificationid);
        session()->flash('message',$message);
        return redirect()->route('projectList');
    }
    public function projectstatus($id)
    {
        $status = ProjectProgressStatus::where('project_id','=',$id)->get();
        $project = Project::where('project_id','=',$id)->first();
        $projectname = $project->project_name;
        return view('project.status',[
                    'status'      => $status,
                    'projectname' => $projectname
                ]);
    }
    public function projectAssociate(Request $request)
    {
        $projectid = $request['projectid'];
        $projectbid = ProjectBid::where('project_id','=',$projectid)
                                ->where('project_bid_status','=',1)
                                ->where('bid_status','=',1)->first();
        $associateid = $projectbid->user_id;
        $associate = User::where('users_id','=',$associateid)->first();
        $associateTypeId = $associate->associate_type_id;
        $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
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
        $company =$associate->users_company;
        $phone = $associate->users_phone;
        $email = $associate->users_email;
        $profileimage = asset("/img/users/" . $associate['users_profile_image']);
        $temp =  array('status'           => 1, 
                       'associatename'    => $username,
                       'associateemail'   => $email,
                       'associatecompany' => $company,
                       'associatephone'   => $phone,
                       'associateimage'   => $profileimage,
                       'associateType'    => $associateType->associate_type,
                        );
        
        return response()->json($temp);
    }
    public function addStatus(Request $request)
    {
        $status = $request['statustxt'];
        $statussubject = $request['subjecttxt'];
        $projectid   = $request['project-id'];
        $userid  = session('loginuserid');
        $inprogress = new ProjectProgressStatus;
        $inprogress->user_id = $userid;
        $inprogress->project_id = $projectid;
        $inprogress->project_progress_status_subject = $statussubject;
        $inprogress->project_progress_status = $status;
        $inprogress->save();
        $associate = ProjectBid::where('project_id','=',$projectid)
                                ->where('project_bid_status','=',1)
                                ->where('bid_status','=',1)
                                ->first();
        $touserid = $associate->user_id;
        $text = 'Project manager added new note!';
        $project = Project::where('project_id','=',$projectid)->first();
        $body = $project->project_name;
        $title = $text;
        $notificationid = '12';
        $this->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
        $temp =  array('status'  => 1, 
                       'message' => 'Notes added successfully'
                      );
        return response()->json($temp);
    }
    public function getAssociatesName(Request $request){
        $appendtd = '';
        if(!empty($request['selectedAssociate']))
        {
            $selectedUser = $request['selectedAssociate'];
            $selectedUser = explode(",",$selectedUser);
            $selectedUser = array_unique($selectedUser);
            $i = 1;
            $appendtd .= '<tr>';
            foreach ($selectedUser as $value) {
                $user = User::where('users_id','=',$value)->first();
                $username = $user->users_name.' '.$user->last_name;
                $appendtd .= '<td style="text-align: left;font-size: 12px;font-weight:normal; color: #2b2929;">'.$username.'</td>';
                if($i % 3 == 0)
                {
                    $appendtd .= '</tr><tr>';
                }
                ++$i;
            }
        }
        return response()->json($appendtd);
    }
    public function getAssociatesProfile(Request $request){
        $appendtd = '';
        if(!empty($request['selectedAssociate']))
        {
            $selectedUser = $request['selectedAssociate'];
            $selectedUser = explode(",",$selectedUser);
            $selectedUser = array_unique($selectedUser);
            foreach ($selectedUser as $value) {
                $user = User::where('users_id','=',$value)->first();
                $associatename = $user->users_name.' '.$user->last_name;
                $associateTypeId = $user->associate_type_id;
                $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
                $associate_type = $associateType->associate_type;
                $profile = $user->users_profile_image;
                $profileimage = asset("/img/users/" . $profile);
                $appendtd .= '<tr><td width="50" class="live-user-td"><img class="img-rounded live-user-image" src="'.$profileimage.'"/></td>
                    <td width="250" class="live-user-td">'.$associatename.'</td>
                    <td width="220" class="live-user-td">'.$associate_type.'</td>
                    <td width="50" class="live-user-td"><button type="button" class="close"  style="color: red;font-size: 25px;">&times;</button></td></tr>';
               
            }
        }
        return response()->json($appendtd);
    }
    public function schedulingProject($id)
    {
        $project = Project::where('project_id','=',$id)->first();
        $projectbidrequest = ProjectBidRequest::where('project_id','=',$id)->get();
        if(isset($projectbidrequest))
        {
            $resetbidrequest = ProjectBidRequest::where('project_id','=',$id)->delete();
        }
        $scope = ScopePerformed::all();
        $setting = Setting::where('setting_status','=',1)->first();
        if(isset($setting) && !empty($setting))
        {
            $minvalue = (string)$setting->min_miles;
            $maxvalue = (string)$setting->max_miles;
        }
        else
        {
            $minvalue = 0;
            $maxvalue = 0;
        }
        $date2 = date($project->report_due_date);
        $datetime2 = new DateTime($date2);
        $reportdate = $datetime2->format("m/d/Y");
        if(!is_null($project->on_site_date))
        {
            $date2 = date($project->on_site_date);
            $datetime2 = new DateTime($date2);
            $onsitedate = $datetime2->format("m/d/Y");    
        }
        else
        {
            $onsitedate = '   -';
        }
        if(!is_null($project->qaqc_date))
        {
            $qaqcDate = date($project->qaqc_date);
            $qaqcDate = new DateTime($qaqcDate);
            $qaqcDate = $qaqcDate->format("m/d/Y");    
        }
        else{
            $qaqcDate = '   -';
        }
        $projectbid = ProjectBid::where('project_id','=',$id)
                                ->where('project_bid_status','=',1)
                                ->first();
        $associateType = AssociateType::all();
        return view('project.schedulingProject',[
                    'scope'         => $scope, 
                    'project'       => $project,
                    'minvalue'      => $minvalue,
                    'maxvalue'      => $maxvalue,
                    'reportdate'    => $reportdate,
                    'onsitedate'    => $onsitedate,
                    'qaqcDate'      => $qaqcDate,
                    'associateType' => $associateType,

                ]);
    }
    public function schedulingNotification(Request $request)
    {
       
        
        $projectId = $request['projectId'];
        if(!empty($request['miles']) && !empty($request['projectId']))
        {
            $miles = $request['miles'];
            if(empty($request['associateTypeId']))
            {
                $associateTypeId = 0;
            }
            else
            {
                $associateTypeId = $request['associateTypeId'];
            }
            
            //$associateTypeId = array(1,2,3);
            $bidRequests = ProjectBidRequest::where('project_id','=',$projectId)
                                            ->where('check_status','=',0)->delete();
            $project = Project::where('project_id','=',$projectId)->first();
            $latitude = $project->latitude;
            $longitude = $project->longitude;
            $scopeId = $project->scope_performed_id;
            $managerId = $project->user_id;
            //$associatetypeid = implode (",",$associateTypeId);
            $result =  DB::select(DB::raw("SELECT users_id , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( $latitude - latitude ) * PI( ) /180 /2 ) , 2 ) + COS( $latitude * PI( ) /180 ) * COS( latitude * PI( ) /180 ) * POWER( SIN( ( $longitude - longitude ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance
                FROM users
                WHERE  user_types_id <>1
                AND users_approval_status <> 0
                AND associate_type_id IN ($associateTypeId)
                HAVING distance <= $miles"));
            $appendtd ='';
            $count = '0';
            /* print_r($result);
            exit;*/
            if(isset($result) && !empty($result))
            {
                
                foreach($result as $value) 
                {
                    $userId = $value->users_id;
                    $scope_Id = UserScopePerformed::where('users_id','=',$userId)->first();
                    $userScopeId = (string)$scope_Id->scope_performed_id;
                    $userScopeId = explode(",",$userScopeId);
                    $scope = explode(",", $scopeId);
                    $scopeflag = 1;
                    //check user scope performed is matches or not
                    foreach ($scope as $scopeid) {
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
                        $bidrequest = ProjectBidRequest::where('project_id','=',$projectId)
                                            ->where('to_user_id','=',$userId)->first();
                
                        if(isset($bidrequest))
                        {
                            $status = $bidrequest->disregarded_status;
                        }
                        else
                        {
                            $model = new ProjectBidRequest;
                            $model->from_user_id = $managerId;
                            $model->to_user_id = $userId;
                            $model->project_id = $projectId;
                            $date = date('Y-m-d H:i:s');
                            $model->created_at = $date;
                            $model->save();
                            $status = 0;
                        }
                    
                    }
                }
            }
          
            $bidrequest = ProjectBidRequest::where('project_id','=',$projectId)
                                        ->where('disregarded_status','=',0)
                                        ->where('bid_request_status','=',0)
                                        ->get();
            $appendtd = '';
            $count = '0';
            if(isset( $bidrequest))
            {
                $count = $bidrequest->count();
                foreach ($bidrequest as $value) {
                    $userId = $value->to_user_id;
                    $user = User::where('users_id','=',$userId)->first();
                    $associatename = $user->users_name.' '.$user->last_name;
                    $associateTypeId = $user->associate_type_id;
                    $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
                    $associate_type = $associateType->associate_type;
                    $profile = $user->users_profile_image;
                    $profileimage = asset("/img/users/" . $profile);
                    $appendtd .= '<tr><td width="50" class="live-user-td"><img class="img-rounded   live-user-image" src="'.$profileimage.'"/></td>
                    <td width="250" class="live-user-td">'.$associatename.'</td>
                    <td width="220" class="live-user-td">'.$associate_type.'</td>
                    <td width="50" class="live-user-td"><button type="button" class="close" onclick="rejectUser('.$userId.')" style="color: red;font-size: 25px;" name="reject-btn">&times;</button></td>
                    </tr>';
           
                }
            }
            
            return response()->json(array('appendtd' => $appendtd,'count' => $count));
        }
        else{
            $appendtd ='';
            $count = '0';
            return response()->json(array('appendtd' => $appendtd,'count' => $count));
        }
        
    }
    public function rejectLiveUser(Request $request)
    {
        $userId = $request['userId'];
        $projectId = $request['projectId'];
        $updatebidrequest = ProjectBidRequest::where('to_user_id','=',$userId)
                                        ->where('project_id','=',$projectId)
                                        ->update(['disregarded_status'=> 1,
                                                  'check_status' =>0]);
        $bidrequest = ProjectBidRequest::where('project_id','=',$projectId)
                                        ->where('disregarded_status','=',0)
                                        ->where('bid_request_status','=',0)
                                        ->get();
        $appendtd = '';
        $count = '0';
        if(isset($bidrequest))
        {
            $count = $bidrequest->count();
            foreach ($bidrequest as $value) {
                $userId = $value->to_user_id;
                $userBidRequest = ProjectBidRequest::where('project_id','=',$userId)
                                                ->where('to_user_id','=',$userId)->first();

                $user = User::where('users_id','=',$userId)->first();
                $associatename = $user->users_name.' '.$user->last_name;
                $associateTypeId = $user->associate_type_id;
                $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
                $associate_type = $associateType->associate_type;
                $profile = $user->users_profile_image;
                $profileimage = asset("/img/users/" . $profile);
                $appendtd .= '<tr><td width="50" class="live-user-td"><img class="img-rounded   live-user-image" src="'.$profileimage.'"/></td>
                <td width="250" class="live-user-td">'.$associatename.'</td>
                <td width="220" class="live-user-td">'.$associate_type.'</td>
                <td width="50" class="live-user-td"><button type="button" class="close" onclick="rejectUser('.$userId.')" style="color: red;font-size: 25px;" name="reject-btn">&times;</button></td>
                </tr>';
           
            }
        }
        return response()->json(array('appendtd' => $appendtd,'count' => $count));
    }
    public function getLiveUserList(Request $request)
    {
        $projectid = $request['projectid'];
        $bidrequest = ProjectBidRequest::where('project_id','=',$projectid)
                                        ->where('disregarded_status','=',0)
                                        ->where('bid_request_status','=',0)
                                        ->get();

        $appendtd = '';
        $count = '0';
        if(isset($bidrequest))
        {
            $count = $bidrequest->count();
            foreach ($bidrequest as $value) {
                $userId = $value->to_user_id;
                $user = User::where('users_id','=',$userId)->first();
                $associatename = $user->users_name.' '.$user->last_name;
                $associateTypeId = $user->associate_type_id;
                $associateType = AssociateType::where('associate_type_id','=',$associateTypeId)->first();
                $associate_type = $associateType->associate_type;
                $profile = $user->users_profile_image;
                $profileimage = asset("/img/users/" . $profile);
                $appendtd .= '<tr><td width="50" class="live-user-td"><img class="img-rounded   live-user-image" src="'.$profileimage.'"/></td>
                    <td width="250" class="live-user-td">'.$associatename.'</td>
                    <td width="220" class="live-user-td">'.$associate_type.'</td>
                    <td width="50" class="live-user-td"><button type="button" class="close" onclick="rejectUser('.$userId.')" style="color: red;font-size: 25px;" name="reject-btn">&times;</button></td>
                    </tr>';
           
            }
        }
        return response()->json(array('appendtd' => $appendtd,'count' => $count));
        
    }
    public function changeCheckStatus(Request $request)
    {
        $projectid = $request['projectid'];
        $userid = $request['userid'];
        $status = $request['status'];
        $project = Project::where('project_id','=',$projectid)->first();
        $managerId = $project->user_id;
        $bidrequest = ProjectBidRequest::where('project_id','=',$projectid)
                                        ->where('to_user_id','=',$userid)->first();
        if(isset($bidrequest))
        {
            $bidmodel = ProjectBidRequest::where('project_id','=',$projectid)
                                        ->where('to_user_id','=',$userid)
                                        ->update(['check_status']);
        }
        else
        {
            $model = new ProjectBidRequest;
            $model->to_user_id = $userid;
            $model->from_user_id = $managerId;
            $model->check_status = 1;
            $model->project_id = $projectid;
            $date = date('Y-m-d H:i:s');
            $model->created_at = $date;
            $model->save();

        }
        return response()->json(array('status' => 1));
    }
    public function sendProjectNotification(Request $request)
    {
        $projectid = $request['projectid'];
        $miles = $request['miles'];
        $associate_type_id = $request['associate_type_id'];
        $bid = $request['bid'];
        $updateProject = Project::where('project_id','=',$projectid)
                                ->update(['milesrange'       => $miles,
                                          'employee_type_id' => $associate_type_id,
                                          'approx_bid'       => $bid]);
        $project = Project::where('project_id','=',$projectid)->first();
        $fromuserid = $project->user_id;
        $updatebidrequest = ProjectBidRequest::where('project_id','=',$projectid)
                                        ->where('disregarded_status','=',0)
                                        ->where('bid_request_status','=',0)
                                        ->update(['request_send_status' => 1]);
        $bidrequest = ProjectBidRequest::where('project_id','=',$projectid)
                                        ->where('disregarded_status','=',0)
                                        ->where('bid_request_status','=',0)
                                        ->get();
        if(isset($bidrequest))
        {
            foreach ($bidrequest as $value) {
                $touserid = $value->to_user_id;
                $notificationtext = 'New project listed in your area!';
                $notificationtype = '1'; //1 for create project
                $projectid = (string)$projectid;
                //$fromuserid = $request->input('managerid');
                $body = $project->project_name;
                $title = 'New project listed in your area!';
                $this->sendUserNotification($touserid,$fromuserid,$projectid,$body,$title,$notificationtext,$notificationtype);
            }
        }
        $updateStatus = ProjectStatus::where('project_id','=',$projectid)
                                    ->where('project_status_type_id','=',7)
                                    ->update(['project_status_type_id' => 1,
                                              'created_at' => date('Y-m-d H:i:s')]);
        return response()->json(array('status' => 1,'message' => 'Project scheduled successfully'));

        /*$model = new ProjectStatus;
        $model->project_id = $projectid;
        $model->project_status_type_id = 1;
        $date = date('Y-m-d H:i:s');
        $model->created_at = $date;
        $model->save();*/
    }
    public function archiveProjects()
    {
        $projects       = ProjectStatus::where('project_status_type_id','=',8)
                                        ->orderBy('created_at','desc')->get();
        $projectCount   = $projects->count();
        $archiveProject = '';
        if(isset($projects) && !empty($projects))
        {
            foreach ($projects as $value) {
                $project    = Project::where('project_id','=',$value->project_id)->first();
                $created_at = (String)$project->created_at;
                $datetime2  = new DateTime($created_at);
                $created_at = $datetime2->format("Y/m/d");
                $managerid  = $project->user_id;
                $user = User::where('users_id','=',$managerid)->first();
                $managername = $user->users_name.' '.$user->last_name;
                $archiveProject[] = ['project_name'            => $project->project_name, 
                                        'project_id'           => $project->project_id,
                                        'project_site_address' => $project->project_site_address,
                                        'budget'               => number_format($project->budget, 2),
                                        'managername'          => $managername,
                                        'created_at'           => $created_at,
                                        ];
            }
        }
        return view('project.archiveProjects',['archiveProject' => $archiveProject,
                                               'projectCount'   => $projectCount]); 
    }
    public function archive($id)
    {
        $projectid = $id;
        $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                    ->where('project_status_type_id','=',7)
                                    ->update(['project_status_type_id' => 8,
                                            'created_at' => date('Y-m-d H:i:s')]);
        $message = 'Project archived successfully!';
        session()->flash('message',$message);
        return redirect()->route('archiveProjects');
    }
    public function batchArchive(Request $request)
    {
        if(isset($request['projectid']) && !empty($request['projectid']))
        {
            $projectids = $request['projectid'];
            $selectedProject = explode(",",$projectids);
            $selectedProject = array_unique($selectedProject);
            foreach ($selectedProject as $value) {
                $projectid = $value;
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                                ->where('project_status_type_id','=',7)
                                                ->update(['project_status_type_id' => 8,
                                                        'created_at' => date('Y-m-d H:i:s')]);
            }
            $temp = array('status' => 1,'message' => 'Project batch archived successfully!');
            return json_encode($temp);
        }
    }
    public function scheduled($id)
    {
        $projectid = $id;
        $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                    ->where('project_status_type_id','=',8)
                                    ->update(['project_status_type_id' => 7,
                                    'created_at' => date('Y-m-d H:i:s')]);
        $message = 'Project Un-Archived successfully!';
        session()->flash('message',$message);
        return redirect()->route('dashboard');
    }
    public function batchScheduled(Request $request)
    {
        if(isset($request['projectid']) && !empty($request['projectid']))
        {
            $projectids = $request['projectid'];
            $selectedProject = explode(",",$projectids);
            $selectedProject = array_unique($selectedProject);
            foreach ($selectedProject as $value) {
                $projectid = $value;
                $projectstatus = ProjectStatus::where('project_id','=',$projectid)
                                                ->where('project_status_type_id','=',8)
                                                ->update(['project_status_type_id' => 7,
                                                          'created_at' => date('Y-m-d H:i:s')]);
            }
            $temp = array('status' => 1,'message' => 'Project batch Un-Archived successfully!');
            return json_encode($temp);
        }
    }
}
