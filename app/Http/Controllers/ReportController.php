<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Project;
use App\ScopePerformed;
use App\ProjectBid;
use App\User;
use DateTime;
require_once(public_path('/lib/PHPExcel/Classes/PHPExcel.php')) ;
require_once(public_path('/lib/PHPExcel/Classes/PHPExcel/IOFactory.php'));
use \PHPExcel; 
use \PHPExcel_IOFactory;
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
        $inprogressProjects = $this->getinprogressProjects($request);
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
        if(isset($inprogressProjects) && !empty($inprogressProjects))
        {
            $inProgressCount = count($inprogressProjects);
        }
        else
        {
            $inProgressCount = 0;
        }
        
        //echo json_encode($scheduledProjects);
       // exit;
        return view('report.reports',['scheduledProjects' => $scheduledProjects,
                                      'remainingProjects' => $remainingProjects,
                                      'inprogressProjects'=> $inprogressProjects,
                                      'scheduledCount'    => $scheduledCount,
                                      'remainingCount'    => $remainingCount,
                                      'inProgressCount'   => $inProgressCount]);
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
                    $appendtd .= '<tr class = "content"><td style="text-align: left;">'.$value['receivedDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['schedulingDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['onSiteDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectNo'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['accountManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['state'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['city'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['scopeNames'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['employeeName'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['associateName'].'</td></tr>';
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
                            ->select('projects.*','project_status.project_status_type_id')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.updated_at','>=',$date)
                            ->where('projects.updated_at','<',$date2)
                            //->whereIn('project_status.project_status_type_id', [7, 8])
                            //->orWhere('project_status.project_status_type_id','=',8)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('projects.updated_at', 'desc')
                            ->get();
        $count = $projects->count();
        if($count > 0)
        {
            foreach ($projects as $value) {
                if($value->project_status_type_id == 7)
                {
                    $receivedDate   = new DateTime($value->updated_at);
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
                    $projectBid = ProjectBid::where(['project_id' => $value->project_id,
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
                    $appendtd .= '<tr class = "content"><td style="text-align: left;">'.$value['receivedDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['schedulingDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['onSiteDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectNo'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['accountManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['state'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['city'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['scopeNames'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['employeeName'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['associateName'].'</td></tr>';
                }
            }
            return json_encode(array('appendtd' => $appendtd,'projectcount' => $projectcount));
        }
    }
    public function getinprogressProjects(Request $request)
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
                            ->select('projects.*','project_status.project_status_type_id')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.updated_at','>=',$date)
                            ->where('projects.updated_at','<',$date2)
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('projects.updated_at', 'desc')
                            ->get();
        $count = $projects->count();
        $inprogresscount = 0;
        if($count > 0)
        {
            foreach ($projects as $value) {
                if($value->project_status_type_id == 1)
                {
                    $inprogresscount++;
                    $receivedDate   = new DateTime($value->updated_at);
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
                    $appendtd .= '<tr class = "content"><td style="text-align: left;">'.$value['receivedDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['schedulingDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['onSiteDate'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectNo'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['accountManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['projectManager'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['state'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['city'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['scopeNames'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['employeeName'].'</td>';
                    $appendtd .= '<td style="text-align: left;">'.$value['associateName'].'</td></tr>';
                }
            }
            return json_encode(array('appendtd'    => $appendtd,
                                    'projectcount' => $inprogresscount));
        }
    }


    public function exportProjects(Request $request)
    {
        //$request['selectedDate'] = '2019-02-07';
        //$request['callFrom'] = 1;
       /* $scheduledProjects = $this->getexportprojects($request['selectedDate']);
        return json_encode($scheduledProjects);*/
        $date = $request->input('datepicker');
        $date = new DateTime($date);
        $date = $date->format("Y-m-d");
        $date2 = $date;
        $date2 = new DateTime($date2);
        $date2->modify('+1 day');
        $date2 = $date2->format('Y-m-d H:i:s');
        $current_excel_filename = strtolower('report-'.$date.'.xlsx');
        $current_excel_filepath = public_path("/img/reports/".$current_excel_filename);
       /* echo $current_excel_filepath;
        exit;*/
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->removeSheetByIndex(0);
        $report_sheet_column_array = array('Date Received',
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
                       );
        /*print_r($report_sheet_column_array);
        exit;*/
        $projects = DB::table('project_bids')
                            ->select('projects.*','project_bids.accepted_rejected_at')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_bids.project_id')
                            ->where('project_bids.project_bid_status','=',1)
                            ->where('project_bids.accepted_rejected_at','>=',$date)
                            ->where('project_bids.accepted_rejected_at','<',$date2)
                            ->orderBy('project_bids.accepted_rejected_at', 'desc')
                            ->get();
        $count = $projects->count();
        if($count > 0)
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
        $rowNumber = 1; //start in row 1
        $newsheet = $objPHPExcel->createSheet();
        $newsheet->setTitle($date.'-SCHEDULED-REPORT');
        $newsheet->mergeCells('A1:K1');
        $newsheet->setCellValue('A1',$date.'-SCHEDULED-REPORT');
        $newsheet->getStyle('A1:K1')->getFont()->setBold(true);
        $rowNumber = 2; //start in row 1
        if($count > 0)
        {
            foreach ($data as $row) {
                $col = 'A'; // start at column A
                if($rowNumber==2){
                    foreach($report_sheet_column_array as $cell) {
                        $newsheet->setCellValue($col.$rowNumber,$cell);
                        $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                        $col++;
                    }
                    $rowNumber++;
                }
                $col = 'A'; // start at column A
                foreach($row as $cell) {
                    $newsheet->setCellValue($col.$rowNumber,$cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
        else
        {
            $col = 'A'; 
            foreach($report_sheet_column_array as $cell) {
                $newsheet->setCellValue($col.$rowNumber,$cell);
                $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                $col++;
            }
        }
        foreach(range('A',$newsheet->getHighestColumn()) as $column) {
            $newsheet->getColumnDimension($column)->setAutoSize(true);
        }
        $remainingprojects = DB::table('project_status')
                            ->select('projects.*','project_status.project_status_type_id')
                            ->leftJoin('projects', 'projects.project_id', '=', 'project_status.project_id')
                            ->where('projects.updated_at','>=',$date)
                            ->where('projects.updated_at','<',$date2)
                            //->whereIn('project_status.project_status_type_id', [7, 8])
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('projects.updated_at', 'desc')
                            ->get();
        /*print_r($remainingprojects);
        exit;*/
        $allprojectcount = $remainingprojects->count();
        $remainingcount  = 0;
        $inprogresscount = 0;
        if($allprojectcount > 0)
        {
            foreach ($remainingprojects as $value) {
                $receivedDate   = new DateTime($value->updated_at);
                $receivedDate   = $receivedDate->format('m/d/Y');
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
                if($value->project_status_type_id == 1)
                {
                    $inprogresscount++;
                    $inprogressData[] = [
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
                if($value->project_status_type_id == 7)
                {
                    $remainingcount++;
                    $remainingData[] = [
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
        }
        //make new sheet for inprogress project
        $rowNumber = 1; //start in row 1
        $newsheet = $objPHPExcel->createSheet();
        $newsheet->setTitle($date.'-IN-PROGRESS-REPORT');
        $newsheet->mergeCells('A1:K1');
        $newsheet->setCellValue('A1',$date.'-SCHEDULING-IN-PROGRESS-REPORT');
        $newsheet->getStyle('A1:K1')->getFont()->setBold(true);
        $rowNumber = 2; //start in row 1
        if($inprogresscount > 0)
        {
            foreach ($inprogressData as $row) {
                //print_r($row);
                //exit;
                $col = 'A'; // start at column A
                if($rowNumber==2){
                    foreach($report_sheet_column_array as $cell) {
                        $newsheet->setCellValue($col.$rowNumber,$cell);
                        $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                        $col++;
                    }
                    $rowNumber++;
                }
                $col = 'A'; // start at column A
                foreach($row as $cell) {
                    $newsheet->setCellValue($col.$rowNumber,$cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
        else
        {
            $col = 'A'; // start at column A
            foreach($report_sheet_column_array as $cell) {
                $newsheet->setCellValue($col.$rowNumber,$cell);
                $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                $col++;
            }
        }
        foreach(range('A',$newsheet->getHighestColumn()) as $column) {
            $newsheet->getColumnDimension($column)->setAutoSize(true);
        }
        //make nwe sheet for remaining projects
        $rowNumber = 1; //start in row 1
        $newsheet = $objPHPExcel->createSheet();
        $newsheet->setTitle($date.'-REMAINING-REPORT');
        $newsheet->mergeCells('A1:K1');
        $newsheet->setCellValue('A1',$date.'-REMAINING-REPORT');
        $newsheet->getStyle('A1:K1')->getFont()->setBold(true);
        $rowNumber = 2; //start in row 1
        if($remainingcount > 0)
        {
            foreach ($remainingData as $row) {
                //print_r($row);
                //exit;
                $col = 'A'; // start at column A
                if($rowNumber==2){
                    foreach($report_sheet_column_array as $cell) {
                        $newsheet->setCellValue($col.$rowNumber,$cell);
                        $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                        $col++;
                    }
                    $rowNumber++;
                }
                $col = 'A'; // start at column A
                foreach($row as $cell) {

                    
                    $newsheet->setCellValue($col.$rowNumber,$cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
        else
        {
            $col = 'A'; // start at column A
            foreach($report_sheet_column_array as $cell) {
                $newsheet->setCellValue($col.$rowNumber,$cell);
                $newsheet->getStyle($col.$rowNumber)->getFont()->setBold(true);
                $col++;
            }
        }
        foreach(range('A',$newsheet->getHighestColumn()) as $column) {
            $newsheet->getColumnDimension($column)->setAutoSize(true);
        }
        //$newsheet->export('xlsx');
        /*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($current_excel_filepath); */
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$current_excel_filename);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //$objWriter->save($current_excel_filepath);
        $objWriter->save("php://output");
        //$objWriter->save($current_excel_filepath); 

    }
    public function getexportprojects($date)
    {
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
                            //->whereIn('project_status.project_status_type_id', [7, 8])
                            ->groupBy('project_status.project_id')
                            ->havingRaw('COUNT(project_status.project_status_type_id) = 1')
                            ->orderBy('projects.created_at', 'desc')
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
