<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Project;
use App\User;
use App\ScopePerformed;
use App\ProjectStatusType;
use App\Setting;
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
}
