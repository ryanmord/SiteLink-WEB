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
use App\Setting;
use DateTime;
use Illuminate\Support\Facades\DB;
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
        $projects = Project::where('user_id','=',$id)->paginate(8);
        $scopeperformed= ScopePerformed::all();
        return view('project.index',[
                    'projects'      => $projects, 
                    'user'          =>$username,
                    'scopeperformed'=>$scopeperformed,
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
    public function allocatedproject()
    {
        $projects = DB::table('projects')
        ->leftJoin('project_bids', 'projects.project_id', '=', 'project_bids.project_id')
        ->where('project_bid_status','=',1)
        ->get();
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
            ->where('project_bid_status','=', 1)->first();
            $associatename = User::where('users_id','=',$projectbid->user_id)
            ->first();
            $data[] = ['project_name' => $value->project_name, 
                'project_site_address' =>  $value->project_site_address,
                'report_due_date' => $value->report_due_date,
                'report_template' => $value->report_template,
                'scope_performed_id' => $value->scope_performed_id,
                'instructions' => $value->instructions,
                'approx_bid' => $value->approx_bid,
                'associatename' => $associatename->users_name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                ];
        }
        /*$projectbid = ProjectBid::where('project_bid_status','=',1)->get();
        $projects = Project::where('user_id','=',$id)->paginate(8);*/
        $scopeperformed= ScopePerformed::all();
        return view('project.allocatedproject',[
                    'projects'      => $data, 
                    'scopeperformed'=>$scopeperformed,
                ]);

    }
    public function nonallocatedproject()
    {
        
        $projects = Project::all();
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)->
                        where('project_bid_status','=',1)->first();
            if(!isset($projectbid))
            {
                $managerid = $value->user_id;
                $user = User::where('users_id','=',$managerid)->first();
                $managername = $user->users_name;
                $data[] = ['project_name' => $value->project_name, 
                'projectid' => $projectid,
                'project_site_address' =>  $value['project_site_address'],
                'report_due_date' => $value->report_due_date,
                'report_template' => $value->report_template,
                'scope_performed_id' => $value->scope_performed_id,
                'instructions' => $value->instructions,
                'approx_bid' => $value->approx_bid,
                'managername' => $managername,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                ];
            }
        }
        $scopeperformed= ScopePerformed::all();
        return view('project.nonallocatedproject',[
                    'projects'      => $data, 
                    'scopeperformed'=>$scopeperformed,
                ]);

    }
    public function projectbid($projectid)
    {
        $projectbid = ProjectBid::where('project_id','=',$projectid)->get();
        $project = Project::where('project_id','=',$projectid)->first();
        $projectname = $project->project_name;
        if(count($projectbid) > 0)
        {
            $project = Project::where('project_id','=',$projectid)->first();
            $projectname = $project->project_name;
            foreach ($projectbid as $value) 
            {
                $associateid = $value->user_id;
                $associate = User::where('users_id','=',$associateid)->first();
                $associatename = $associate->users_name;
                $data[] = ['associatename' => $associatename, 
                'associatebid' =>  $value->associate_suggested_bid,
                'suggestedbid' => $project->approx_bid,
                'createddate' => $value->created_at
                ];
            }
            return view('project.viewbids',[
                    'bids'      => $data, 
                    'projectname' => $projectname,
                ]);
        }
        else
        {
            return view('project.viewbids',[
                
                    'projectname' => $projectname,
            ]);
        }
    }
    public function completedproject()
    {
         $projects = DB::table('projects')
        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
        ->where('project_status_type_id','=',4)
        ->get();

        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
            ->where('project_bid_status','=', 1)->first();
            $associatename = User::where('users_id','=',$projectbid->user_id)
            ->first();
            $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',4)->first();
            $data[] = ['project_name' => $value->project_name, 
                'project_site_address' =>  $value->project_site_address,
                'report_due_date' => $value->report_due_date,
                'report_template' => $value->report_template,
                'scope_performed_id' => $value->scope_performed_id,
                'instructions' => $value->instructions,
                'approx_bid' => $projectbid->associate_suggested_bid,
                'associatename' => $associatename->users_name,
                'created_at' => $value->created_at,
                'completeddate' => $status->created_at,
                ];
        }
        /*$projectbid = ProjectBid::where('project_bid_status','=',1)->get();
        $projects = Project::where('user_id','=',$id)->paginate(8);*/
        $scopeperformed= ScopePerformed::all();
        return view('project.completedproject',[
                    'projects'      => $data, 
                    'scopeperformed'=>$scopeperformed,
                ]);
    }
    public function cancelledproject()
    {
         $projects = DB::table('projects')
         ->select('projects.project_name','projects.project_id','projects.project_site_address','projects.report_due_date','projects.report_template','projects.scope_performed_id','projects.instructions','projects.created_at')
        ->leftJoin('project_status', 'projects.project_id', '=', 'project_status.project_id')
        ->where('project_status_type_id','=',5)
        ->get();
       
        foreach ($projects as $value) 
        {
            $projectid = $value->project_id;
            $projectbid = ProjectBid::where('project_id','=',$projectid)
            ->where('project_bid_status','=', 1)->first();
            $associatename = User::where('users_id','=',$projectbid->user_id)
            ->first();
            $status = ProjectStatus::where('project_id','=',$projectid)
                    ->where('project_status_type_id','=',5)->first();
            $data[] = ['project_name' => $value->project_name, 
                'project_site_address' =>  $value->project_site_address,
                'report_due_date' => $value->report_due_date,
                'report_template' => $value->report_template,
                'scope_performed_id' => $value->scope_performed_id,
                'instructions' => $value->instructions,
                'createddate' => $value->created_at,
                'approx_bid' => $projectbid->associate_suggested_bid,
                'associatename' => $associatename->users_name,
                'cancelleddate' => $status->created_at,
                ];

        }
        
        /*$projectbid = ProjectBid::where('project_bid_status','=',1)->get();
        $projects = Project::where('user_id','=',$id)->paginate(8);*/
        $scopeperformed= ScopePerformed::all();
        return view('project.cancelledproject',[
                    'projects'      => $data, 
                    'scopeperformed'=>$scopeperformed,
                ]);
    }
}
