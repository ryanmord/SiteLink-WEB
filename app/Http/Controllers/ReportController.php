<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Project;
use App\ScopePerformed;
use App\ProjectBid;
use App\User;
use DateTime;
class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $request = new Request;
        $request['selectedDate'] = $date;
        //$request['selectedDate'] = '2019-03-13';
        $request['callFrom'] = 1;
        $scheduledProjects = $this->getScheduledProjects($request);
       
        //$request['selectedDate'] = '2019-03-13';
        $remainingProjects = $this->getRemainingProjects($request);
       /* print_r($remainingProjects);
        exit;*/
        if(isset($scheduledProjects) && !empty($scheduledProjects))
        {
            $scheduledCount = count($scheduledProjects);
        }
        else
        {
            $scheduledCount = 0;
        }
        if(isset($remainingProjects) && !empty($remainingProjects))
        {
            $remainingCount = count($remainingProjects);
        }
        else
        {
            $remainingCount = 0;
        }
        
        //echo json_encode($scheduledProjects);
       // exit;
        return view('report.reports',['scheduledProjects' => $scheduledProjects,
                                      'remainingProjects' => $remainingProjects,
                                      'scheduledCount'    => $scheduledCount,
                                      'remainingCount'    => $remainingCount,]);
    }
    public function getScheduledProjects(Request $request)
    {
        $date = $request['selectedDate'];
        $data = '';
        $appendtd = '';
        $projectcount = 0;
        $date = new DateTime($date);
        $date = $date->format("Y-m-d H:i:s");
        $date2 = $date;
        $date2 = new DateTime($date2);
        $date2->modify('+1 day');
        $date2 = $date2->format('Y-m-d H:i:s');
        $projects = DB::table('project_bids')
                            ->select('projects.*','project_bids.accepted_rejected_at')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_bids.project_id')
                            ->where('project_bids.project_bid_status','=',1)
                            ->where('project_bids.accepted_rejected_at','>=',$date)
                            ->where('project_bids.accepted_rejected_at','<',$date2)
                            ->orderBy('project_bids.accepted_rejected_at', 'desc')
                            ->get();
        if(isset($projects) && !empty($projects))
        {
            foreach ($projects as $value) {
                $receivedDate   = new DateTime($value->created_at);
                $receivedDate   = $receivedDate->format('m/d/Y');
                $schedulingDate = new DateTime($value->accepted_rejected_at);
                $schedulingDate = $schedulingDate->format('m/d/Y');
                if(!is_null($value->on_site_date))
                {
                    $onSiteDate = new DateTime($value->on_site_date);
                    $onSiteDate = $onSiteDate->format('m/d/Y');
                }
                else
                {
                    $onSiteDate = '';
                }
                $projectNo = $managerName = $accountManager = '';
                $managerid = $value->user_id;
                $manager   = User::where('users_id','=',$managerid)->first();
                if(isset($manager) && !empty($manager))
                {
                    $managerName = $manager->users_name.' '.$manager->last_name;
                }
                $scopeid   =  $value->scope_performed_id;
                $scope     =  explode(",",$scopeid);
                $scopeNames = $employeeName = $associateName = '';
                foreach ($scope as  $scopes) {
                   $scopeperformed = ScopePerformed::select('scope_performed')
                                            ->where(['scope_status'       => 1,
                                                     'scope_performed_id' => $scopes])
                                            ->first();
                    $scopeNames .= $scopeperformed->scope_performed.' ';
                }
                $projectBid = ProjectBid::where(['project_id'         => $value->project_id,
                                                 'project_bid_status' => 1,
                                                 'bid_status'         => 1])->first();
                if(isset($projectBid) && !empty($projectBid))
                {
                    $associateId = $projectBid->user_id;
                    $associate = User::where('users_id','=',$associateId)->first();
                    if($associate->associate_type_id == 1)
                    {
                        $employeeName = $associate->users_name.' '.$associate->last_name;
                    }
                    else
                    {
                        $associateName = $associate->users_name.' '.$associate->last_name;
                    }
                }
                $data[] = ['projectId'      => $value->project_id,
                           'receivedDate'   => $receivedDate,
                           'schedulingDate' => $schedulingDate,
                           'onSiteDate'     => $onSiteDate,
                           'projectNo'      => $value->project_number,
                           'accountManager' => $accountManager,
                           'projectManager' => $managerName,
                           'city'           => $value->city,
                           'state'          => $value->state,
                           'scopeNames'     => $scopeNames,
                           'employeeName'   => $employeeName,
                           'associateName'  => $associateName
                           ];
            }
        }
        if(isset($request['callFrom']))
        {
            return $data; 
        }
        else
        {
            if(isset($data) && !empty($data))
            {
                $projectcount = count($data);
                foreach ($data as $value) {
                    $appendtd .= '<tr class = "content"><td>'.$value['receivedDate'].'</td>';
                    $appendtd .= '<td>'.$value['schedulingDate'].'</td>';
                    $appendtd .= '<td>'.$value['onSiteDate'].'</td>';
                    $appendtd .= '<td>'.$value['projectNo'].'</td>';
                    $appendtd .= '<td>'.$value['accountManager'].'</td>';
                    $appendtd .= '<td>'.$value['projectManager'].'</td>';
                    $appendtd .= '<td>'.$value['state'].'</td>';
                    $appendtd .= '<td>'.$value['city'].'</td>';
                    $appendtd .= '<td>'.$value['scopeNames'].'</td>';
                    $appendtd .= '<td>'.$value['employeeName'].'</td>';
                    $appendtd .= '<td>'.$value['associateName'].'</td></tr>';
                }
            }
            return json_encode(array('appendtd' => $appendtd,'projectcount' => $projectcount));
        }
    }
    public function getRemainingProjects(Request $request)
    {
        $date = $request['selectedDate'];
        $projectcount = 0;
        $data = '';
        $appendtd = '';
        $date = new DateTime($date);
        $date = $date->format("Y-m-d H:i:s");
        $date2 = $date;
        $date2 = new DateTime($date2);
        $date2->modify('+1 day');
        $date2 = $date2->format('Y-m-d H:i:s');
        $projects = DB::table('project_status')
                            ->select('projects.*')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.created_at','>=',$date)
                            ->where('projects.created_at','<',$date2)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('project_status.created_at', 'desc')
                            ->get();
        $count = $projects->count();
        if($count > 0)
        {
            foreach ($projects as $value) {
                $receivedDate   = new DateTime($value->created_at);
                $receivedDate   = $receivedDate->format('m/d/Y');
                /*$schedulingDate = new DateTime($value->updated_at);
                $schedulingDate = $schedulingDate->format('m/d/Y');*/
                $schedulingDate = '';
                if(!is_null($value->on_site_date))
                {
                    $onSiteDate = new DateTime($value->on_site_date);
                    $onSiteDate = $onSiteDate->format('m/d/Y');
                }
                else
                {
                    $onSiteDate = '';
                }
                $projectNo = $managerName = $accountManager = '';
                $managerid = $value->user_id;
                $manager   = User::where('users_id','=',$managerid)->first();
                if(isset($manager) && !empty($manager))
                {
                    $managerName = $manager->users_name.' '.$manager->last_name;
                }
                $scopeid   =  $value->scope_performed_id;
                $scope     =  explode(",",$scopeid);
                $scopeNames = $employeeName = $associateName = '';
                foreach ($scope as  $scopes) {
                   $scopeperformed = ScopePerformed::select('scope_performed')
                                            ->where(['scope_status'       => 1,
                                                     'scope_performed_id' => $scopes])
                                            ->first();
                    $scopeNames .= $scopeperformed->scope_performed.' ';
                }
                $projectBid = ProjectBid::where(['project_id'         => $value->project_id,
                                                 'project_bid_status' => 1,
                                                 'bid_status'         => 1])->first();
                if(isset($projectBid) && !empty($projectBid))
                {
                    $associateId = $projectBid->user_id;
                    $associate = User::where('users_id','=',$associateId)->first();
                    if($associate->associate_type_id == 1)
                    {
                        $employeeName = $associate->users_name.' '.$associate->last_name;
                    }
                    else
                    {
                        $associateName = $associate->users_name.' '.$associate->last_name;
                    }
                }
                $data[] = ['projectId'      => $value->project_id,
                           'receivedDate'   => $receivedDate,
                           'schedulingDate' => $schedulingDate,
                           'onSiteDate'     => $onSiteDate,
                           'projectNo'      => $value->project_number,
                           'accountManager' => $accountManager,
                           'projectManager' => $managerName,
                           'city'           => $value->city,
                           'state'          => $value->state,
                           'scopeNames'     => $scopeNames,
                           'employeeName'   => $employeeName,
                           'associateName'  => $associateName
                           ];
            }
            
        }
        if(isset($request['callFrom']))
        {
            return $data; 
        }
        else
        {
            if(isset($data) && !empty($data))
            {
                $projectcount = count($data);
                foreach ($data as $value) {
                    $appendtd .= '<tr class = "content"><td>'.$value['receivedDate'].'</td>';
                    $appendtd .= '<td>'.$value['schedulingDate'].'</td>';
                    $appendtd .= '<td>'.$value['onSiteDate'].'</td>';
                    $appendtd .= '<td>'.$value['projectNo'].'</td>';
                    $appendtd .= '<td>'.$value['accountManager'].'</td>';
                    $appendtd .= '<td>'.$value['projectManager'].'</td>';
                    $appendtd .= '<td>'.$value['state'].'</td>';
                    $appendtd .= '<td>'.$value['city'].'</td>';
                    $appendtd .= '<td>'.$value['scopeNames'].'</td>';
                    $appendtd .= '<td>'.$value['employeeName'].'</td>';
                    $appendtd .= '<td>'.$value['associateName'].'</td></tr>';
                }
            }
            return json_encode(array('appendtd' => $appendtd,'projectcount' => $projectcount));
        }
    }
    public function exportProjects(Request $request)
    {
        //$request['selectedDate'] = '2019-02-07';
        //$request['callFrom'] = 1;
        $scheduledProjects = $this->getexportprojects($request['selectedDate']);
        return json_encode($scheduledProjects);
    }
    public function getexportprojects($date)
    {
        /*$date = $request['selectedDate'];*/
        $data = '';
        $appendtd = '';
        $projectcount = 0;
        $date = new DateTime($date);
        $date = $date->format("Y-m-d H:i:s");
        $date2 = $date;
        $date2 = new DateTime($date2);
        $date2->modify('+1 day');
        $date2 = $date2->format('Y-m-d H:i:s');
        $projects = DB::table('project_bids')
                            ->select('projects.*','project_bids.accepted_rejected_at')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_bids.project_id')
                            ->where('project_bids.project_bid_status','=',1)
                            ->where('project_bids.accepted_rejected_at','>=',$date)
                            ->where('project_bids.accepted_rejected_at','<',$date2)
                            ->orderBy('project_bids.accepted_rejected_at', 'desc')
                            ->get();
        $count = $projects->count();
        if($count != 0)
        {
            $data[] = ['Date Received',
                        'Date Scheduled',
                        'On-site Date',
                        'Project Number',
                        'Account Manager',
                        'Project Manager',
                        'State',
                        'City',
                        'Scope',
                        'Employee',
                        'Associate',
                        
                        ];
            foreach ($projects as $value) {
                $receivedDate   = new DateTime($value->created_at);
                $receivedDate   = $receivedDate->format('m/d/Y');
                $schedulingDate = new DateTime($value->updated_at);
                $schedulingDate = $schedulingDate->format('m/d/Y');
                if(!is_null($value->on_site_date))
                {
                    $onSiteDate = new DateTime($value->on_site_date);
                    $onSiteDate = $onSiteDate->format('m/d/Y');
                }
                else
                {
                    $onSiteDate = '';
                }
                $projectNo = $managerName = $accountManager = '';
                $managerid = $value->user_id;
                $manager   = User::where('users_id','=',$managerid)->first();
                if(isset($manager) && !empty($manager))
                {
                    $managerName = $manager->users_name.' '.$manager->last_name;
                }
                $scopeid   =  $value->scope_performed_id;
                $scope     =  explode(",",$scopeid);
                $scopeNames = $employeeName = $associateName = '';
                foreach ($scope as  $scopes) {
                   $scopeperformed = ScopePerformed::select('scope_performed')
                                            ->where(['scope_status'       => 1,
                                                     'scope_performed_id' => $scopes])
                                            ->first();
                    $scopeNames .= $scopeperformed->scope_performed.' ';
                }
                $projectBid = ProjectBid::where(['project_id'         => $value->project_id,
                                                 'project_bid_status' => 1,
                                                 'bid_status'         => 1])->first();
                if(isset($projectBid) && !empty($projectBid))
                {
                    $associateId = $projectBid->user_id;
                    $associate = User::where('users_id','=',$associateId)->first();
                    if($associate->associate_type_id == 1)
                    {
                        $employeeName = $associate->users_name.' '.$associate->last_name;
                    }
                    else
                    {
                        $associateName = $associate->users_name.' '.$associate->last_name;
                    }
                }
                $data[] = [
                           $receivedDate,
                           $schedulingDate,
                           $onSiteDate,
                           $value->project_number,
                           $accountManager,
                           $managerName,
                           $value->state,
                           $value->city,
                           $scopeNames,
                           $employeeName,
                           $associateName
                           ];
            }
        }
        return $data;
    }
    public function exportremaining(Request $request)
    {
        //$request['selectedDate'] = '2019-02-07';
        //$request['callFrom'] = 1;
        $date = $request['selectedDate'];
        $data = '';
        $appendtd = '';
        $projectcount = 0;
        $date = new DateTime($date);
        $date = $date->format("Y-m-d H:i:s");
        $date2 = $date;
        $date2 = new DateTime($date2);
        $date2->modify('+1 day');
        $date2 = $date2->format('Y-m-d H:i:s');
        $projects = DB::table('project_status')
                            ->select('projects.*')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.created_at','>=',$date)
                            ->where('projects.created_at','<',$date2)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('project_status.created_at', 'desc')
                            ->get();
        $count = $projects->count();
        if($count != 0)
        {
            $data[] = ['Date Received',
                        'Date Scheduled',
                        'On-site Date',
                        'Project Number',
                        'Account Manager',
                        'Project Manager',
                        'State',
                        'City',
                        'Scope',
                        'Employee',
                        'Associate',
                        
                        ];
            foreach ($projects as $value) {
                $receivedDate   = new DateTime($value->created_at);
                $receivedDate   = $receivedDate->format('m/d/Y');
                $schedulingDate = new DateTime($value->updated_at);
                $schedulingDate = $schedulingDate->format('m/d/Y');
                if(!is_null($value->on_site_date))
                {
                    $onSiteDate = new DateTime($value->on_site_date);
                    $onSiteDate = $onSiteDate->format('m/d/Y');
                }
                else
                {
                    $onSiteDate = '';
                }
                $projectNo = $managerName = $accountManager = '';
                $managerid = $value->user_id;
                $manager   = User::where('users_id','=',$managerid)->first();
                if(isset($manager) && !empty($manager))
                {
                    $managerName = $manager->users_name.' '.$manager->last_name;
                }
                $scopeid   =  $value->scope_performed_id;
                $scope     =  explode(",",$scopeid);
                $scopeNames = $employeeName = $associateName = '';
                foreach ($scope as  $scopes) {
                   $scopeperformed = ScopePerformed::select('scope_performed')
                                            ->where(['scope_status'       => 1,
                                                     'scope_performed_id' => $scopes])
                                            ->first();
                    $scopeNames .= $scopeperformed->scope_performed.' ';
                }
               
                $data[] = [
                           $receivedDate,
                           $schedulingDate,
                           $onSiteDate,
                           $value->project_number,
                           $accountManager,
                           $managerName,
                           $value->state,
                           $value->city,
                           $scopeNames,
                           $employeeName,
                           $associateName
                           ];
            }
        }
        return json_encode($data);
    }

}
