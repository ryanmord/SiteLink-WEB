<?php

namespace App\Http\Controllers\FrontController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\ProjectStatus;
use App\ProgressStatusType;
use App\Project;
use Illuminate\Support\Facades\DB;
use DateTime;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = new Request;
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        $availableProject = $apiobj->availableProject($request);
        $availableProject = json_decode($availableProject, true);
        if($availableProject['status'] == 1)
        {
            $projects = $availableProject['publishprojects'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            $request['callFunction'] = 1;
           
            $publish_projectdetail = $this->show($request);
            
        }
        if(!isset($publish_projectdetail))
        {
            $publish_projectdetail = null;
        }
        $inprogressproject = $apiobj->inProgessProject($request);
        $inprogressproject = json_decode($inprogressproject, true);
        if($inprogressproject['status'] == 1)
        {
            $projects = $inprogressproject['inprogressproject'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            //for calling function 
            $request['callFunction'] = 1;
           
            $projectdetail = $this->show($request);
            
        }
        if(!isset($projectdetail))
        {
            $projectdetail = null;
        }
       
        $projecthistorylist = $apiobj->projectHistory($request);
        $projecthistorylist = json_decode($projecthistorylist, true);

        if($projecthistorylist['status'] == 1)
        {
            $projects = $projecthistorylist['projects'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            //for calling function 
            $request['callFunction'] = 1;
           
            $history_projectdetail = $this->show($request);
        }
        
        if(!isset($history_projectdetail))
        {
            $history_projectdetail = null;
        }
        $progressStatus = ProgressStatusType::all();
        return view('frontview.projects.project',['inprogressproject' => $inprogressproject,
                                        'progresProjecDetail'   => $projectdetail,
                                        'projecthistorylist'    => $projecthistorylist,
                                        'history_projectdetail' => $history_projectdetail,
                                        'publish_projectdetail' => $publish_projectdetail,
                                        'availableProject'      => $availableProject,
                                        'progressStatus'        => $progressStatus
                                        ]);
        
    }
    public function searchProjectHistory(Request $request) {
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        
        $searchKeyword = $request['search_keyword'];
        $projecthistorylist = $apiobj->projectHistory($request,$searchKeyword);
        $projecthistorylist = json_decode($projecthistorylist, true);

        if($projecthistorylist['status'] == 1)
        {
            $projects = $projecthistorylist['projects'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            //for calling function 
            $request['callFunction'] = 1;
           
            $history_projectdetail = $this->show($request);
        }
        
        if(!isset($history_projectdetail))
        {
            $history_projectdetail = null;
        }
        $appendLi = "";
        if (!empty($projecthistorylist)) {

            if (!empty($projecthistorylist['projects'])) {
                
                $i = 1;
                foreach ($projecthistorylist['projects'] as $value) {
                    if($i == 1){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" >
                                        <a href="#history1" class ="active odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                         $appendLi .= '</a></li>';
                    }
                    elseif($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                        $appendLi .= '</a></li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                        $appendLi .= '</a></li>';             
                    }                
                    ++$i;
                }
            }
        }

        $temp = array('appendLi'             => $appendLi,
                      'history_projectdetail' => $history_projectdetail
                     
                    );

        return response()->json($temp);

    }
    
    public function searchProject(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        $searchKeyword = $request['search_keyword'];
        $availableProject = $apiobj->availableProject($request,$searchKeyword);
        $availableProject = json_decode($availableProject, true);
        //echo "<pre>"; print_r($availableProject['status']); exit;

        if($availableProject['status'] == 1)
        {
            $projects = $availableProject['publishprojects'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            $request['callFunction'] = 1;
            $projectdetail = $this->show($request);
        }
        if(!isset($projectdetail))
        {
            $projectdetail = null;
        }
        if(!isset($manager))
        {
            $manager = null;
        }

        $projectData  = $apiobj->mapAvailableProject($request,$searchKeyword);
        $mapAvailableProject = json_decode($projectData, true);
        $userData = DB::table('users')
                    ->select('users_address','latitude','longitude')
                    ->where('users_id',$request['userid'])
                    ->first();
        $userData = json_decode(json_encode($userData),true);

        $appendLi = "";
        if (!empty($availableProject)) {

            if (!empty($availableProject['publishprojects'])) {
                $appendLi = '';
                $i = 1;
                foreach ($availableProject['publishprojects'] as $k => $value) {
                    if($i == 1){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" >
                                        <a href="#history1" class ="active odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }
                    elseif($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }                
                    ++$i;
                }
            }
        }

        if(isset($mapAvailableProject['publishprojects'])){
            $mapProject = $mapAvailableProject['publishprojects'];
        }
        else{
            $mapProject = array();
        }

        $temp = array('appendLi'             => $appendLi,
                      'userData'             => $userData,
                      'projectdetail'        => $projectdetail,
                      'mapAvailableProject'  => $mapProject
                    );

        return response()->json($temp);
    }
     public function loadAvailableProject(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $search_keyword = $request['search_keyword'];
        $request['limit'] = 10;
        $availableProject = $apiobj->availableProject($request,$search_keyword);
        $availableProject = json_decode($availableProject, true);
       
        $appendLi = "";
        if($availableProject['status'] == 1) {

            if (!empty($availableProject['publishprojects'])) {
                // $appendLi = '<h4>Available Job</h4>';
                $i = 1;
                foreach ($availableProject['publishprojects'] as $k => $value) {
                   
                    if($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }                
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
    //pagination code for inprogressproject list

    public function loadInProgressProject(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 10;
        $inprogressproject = $apiobj->inProgessProject($request);
        $inprogressproject = json_decode($inprogressproject, true);
        $appendLi = "";
        if($inprogressproject['status'] == 1) {

            if (!empty($inprogressproject['inprogressproject'])) {
                // $appendLi = '<h4>Available Job</h4>';
                $i = 1;
                foreach ($inprogressproject['inprogressproject'] as  $value) {
                   
                    if($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" data-id = "'.$value['onholdflag'].'"><a href="#progress1" class ="even" data-toggle="tab">'.$value['projectname'].' <i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['onholdflag'] == 1)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbspOnHold</span>';
                        }
                        $appendLi .= '</a></li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" data-id = "'.$value['onholdflag'].'"><a href="#progress1" class ="odd" data-toggle="tab">'.$value['projectname'].' <i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['onholdflag'] == 1)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbspOnHold</span>';
                        }
                        $appendLi .= '</a></li>';
                    } 
                   
                                 
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

    //pagination code for projecthistory list

    public function historyPagination(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 10;
        $search_keyword = $request['search_keyword'];
        $projecthistorylist = $apiobj->projectHistory($request,$search_keyword);
        $projecthistorylist = json_decode($projecthistorylist, true);
        $appendLi = "";
        if($projecthistorylist['status'] == 1) {

            if (isset($projecthistorylist['projects'])) {
                // $appendLi = '<h4>Available Job</h4>';
                $i = 1;
                foreach ($projecthistorylist['projects'] as $value) {
                    if($i == 1){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" >
                                        <a href="#history1" class ="active odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                         $appendLi .= '</a></li>';
                    }
                    elseif($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                        $appendLi .= '</a></li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#history1" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        if($value['flag'] == 0)
                        {
                            $appendLi .= '<span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                        }
                        $appendLi .= '</a></li>';             
                    }                
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

     public function statusPagination(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['projectid'] = $request['projectid'];
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 4;
        $projectStatus = $apiobj->inprogressStatus($request);
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
    public function show(Request $request)
    {
        $apiobject = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['projectid'] = $request['projectid'];
        $projectdetail = $apiobject->projectDetail($request);
        $projectdetail = json_decode($projectdetail, true);
        $projectname = $projectdetail['projectname'];
        $projectid = '#'.$projectdetail['projectid'];
        $siteaddress = $projectdetail['siteaddress'];
        $createddate = $projectdetail['createddate'];
        $createddate = new DateTime($createddate);
        $createddate = $createddate->format("M jS, Y");
        $reportduedate = $projectdetail['reportduedate'];
        $reportduedate = new DateTime($reportduedate);
        $reportduedate = $reportduedate->format("M jS, Y");
        $siteaddress = $projectdetail['siteaddress'];
        $instructions = $projectdetail['instructions'];
        $template = $projectdetail['template'];
        $jobReachCount = $projectdetail['jobReachCount'];
        $associateTypeId = $projectdetail['associateTypeId'];
        $scope = '';
        foreach ($projectdetail['scopeperformed'] as $value) 
        {
           $scope = $scope.$value['scope_performed'].',  ';
        }
        $approxbid = '$ '.$projectdetail['approxbid'];
        
        if(isset($projectdetail['finalbid']) && $projectdetail['finalbid'] != '0')
        {
            $mybid = '$ '.$projectdetail['finalbid'];
        }
        elseif(isset($projectdetail['previousbid']) && $projectdetail['previousbid'] != '0')
        {
            $mybid = '$ '.$projectdetail['previousbid'];
        }
        else
        {
            $mybid = null;
        }
        if(!empty($projectdetail['onsitedate']))
        {
            $onsitedate = $projectdetail['onsitedate'];
            $onsitedate = new DateTime($onsitedate);
            $onsitedate = $onsitedate->format("M jS, Y");
        }
        else
        {
            $onsitedate = null;
        }
        if(isset($projectdetail['rating']))
        {
            $rating = $projectdetail['rating'];
        }
        else
        {
            $rating = '0.0';
        }
        if(isset($projectdetail['comment']))
        {
            $comment = $projectdetail['comment'];
        }
        else
        {
            $comment = '-';
        }
        if(isset($projectdetail['applydate']))
        {
            $applydate = $projectdetail['applydate'];
            $applydate = new DateTime($applydate);
            $applydate = $applydate->format("M jS, Y");
        }
        else{
            $applydate = null;
        }
        $bidstatus = "";
        if (isset($projectdetail['bidstatus'])) {
            $bidstatus = $projectdetail['bidstatus'];
        }
        $temp =  array('success'          => true, 
                        'projectname'     =>$projectname,
                        'projectid'       => $projectid,
                        'createddate'     => $createddate,
                        'siteaddress'     => $siteaddress,
                        'reportduedate'   => $reportduedate,
                        'instructions'    => $instructions,
                        'template'        => $template,
                        'scope'           => $scope,
                        'approxbid'       => $approxbid,
                        'mybid'           => $mybid,
                        'onsitedate'      => $onsitedate,
                        'project_id'      => $projectdetail['projectid'],
                        'rating'          => $rating,
                        'comment'         => $comment,
                        'applydate'       => $applydate,
                        'bidstatus'       => $bidstatus,
                        'jobReachCount'   => $jobReachCount,
                        'associateTypeId' => $associateTypeId);
        
        if(isset($request['callFunction']))
        {
            return $temp;

        }
        return response()->json($temp);
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
    public function update(Request $request, $id)
    {
        //
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
    public function projectbids()
    {
        $request = new Request;
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        $availableProject = $apiobj->availableProject($request);
        $availableProject = json_decode($availableProject, true);
        if($availableProject['status'] == 1)
        {
            $projects = $availableProject['publishprojects'];
            foreach ($projects as $value) 
            {
                $request['projectid'] = $value['projectid'];
                break;
            }
            $request['callFunction'] = 1;
           
            $projectdetail = $this->show($request);
            
        }
        if(!isset($projectdetail))
        {
            $projectdetail = null;
        }
        $projectData  = $apiobj->mapAvailableProject($request);
        $mapAvailableProject = json_decode($projectData, true);
        $userData = DB::table('users')
                    ->select('users_address','latitude','longitude')
                    ->where('users_id',$request['userid'])
                    ->first();
        $userData = json_decode(json_encode($userData),true);
        if(!isset($mapAvailableProject['publishprojects']))
        {
            $mapAvailableProject['publishprojects'] = '';
        }
        return view('frontview.projects.mybids',['availableProject'     => $availableProject,
                                                 'projectdetail'        => $projectdetail,
                                                 'mapAvailableProject'  => $mapAvailableProject['publishprojects'],
                                                 'userData'             => $userData
                                                 ]);
    }
    public function viewManagerProfile(Request $request)
    {
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobj = new ApiController;
        $manager = $apiobj->viewProfile($request);
        $manager = json_decode($manager, true);
        $temp =  array('success'        => true, 
                       'managername'    => $manager['username'],
                       'manageremail'   => $manager['email'],
                       'managercompany' => $manager['company'],
                       'managerphone'   => $manager['phone'],
                       'managerimage'   => $manager['profileimage']
                        );
        
        return response()->json($temp);

    }
    public function applyBid(Request $request)
    {

        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobj = new ApiController;
        $bidrequest = $apiobj->bidrequest($request);
        $bidrequest = json_decode($bidrequest, true);
        return response()->json($bidrequest);
    }
    public function acceptProject(Request $request)
    {

        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobj = new ApiController;
        $accept_project = $apiobj->acceptProject($request);
        $accept_project = json_decode($accept_project, true);
        return response()->json($accept_project);
    }
    public function declineProject(Request $request)
    {

        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobj = new ApiController;
        $decline_project = $apiobj->declineProject($request);
        $decline_project = json_decode($decline_project, true);
        return response()->json($decline_project);
    }
    public function viewStatus(Request $request)
    {
        $projectid = $request['projectid'];
        
        $request['userid'] = session('associateId');
        
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit']   = 4;
        $apiobj = new ApiController;
        $projectstatus = $apiobj->inprogressStatus($request);
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
    public function addStatus(Request $request)
    {
        $this->validate($request, [
            'subjecttxt'    => 'required|max:255',
            'statustxt'     => 'required|max:255',
            ],
            ['subjecttxt.required' => 'Subject field is required',
            'statustxt.required'   => 'Status field is required',
            'subjecttxt.max'       => 'Subject field lenght is to long',
            'statustxt.max'        => 'Status field lenght is to long']);
        $request['status'] = $request['statustxt'];
        $request['subject'] = $request['subjecttxt'];
        $request['projectid'] = $request['project-id'];
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobj = new ApiController;
        $storestatus = $apiobj->addStatus($request);
        $storestatus = json_decode($storestatus, true);
        return response()->json($storestatus);
    }
    public function readNotification(Request $request)
    {
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['notificationid'] = $request['notificationid'];
        $object = new ApiController;
        $readstatus = $object->readNotification($request);
        $storestatus = json_decode($readstatus, true);
        return response()->json($readstatus);
    }
    public function getSettings(Request $request)
    {   
        $apiobject = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $settingdetail = $apiobject->getsettings($request);
        $settingdetail = json_decode($settingdetail, true);
       
        return response()->json($settingdetail);
    }

    public function updateSettings(Request $request)
    {
        $apiobject = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
       if (!isset($request['availability'])) {
            $request['availability'] = "0";
        }

        if (!isset($request['notification'])) {
            $request['notification'] = "0";
        }

        $resultUpdate = $apiobject->updateSettings($request);
        $resultUpdate = json_decode($resultUpdate, true);
       
        return response()->json($resultUpdate);
    }

    //this function is called when click on notification button
    public function projectInfo(Request $request)
    {
        $projectid = $request['projectid'];
        $projectstatus = ProjectStatus::where('project_id','=',$projectid)->get();
        $project = Project::where('project_id','=',$projectid)->first();
        $projectname = $project->project_name;
        foreach ($projectstatus as $value) {
            $status = $value['project_status_type_id'];
        }
        $projectinfo = array('status'=> $status,'projectname' => $projectname);
        return response()->json($projectinfo);
    }


}
