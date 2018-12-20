<?php
namespace App\Http\Controllers;
use App\User;
use App\UserType;
Use App\UserScopePerformed;
Use App\ScopePerformed;
use App\AdminUser;
use App\Project;
use App\ProjectBid;
use App\Mail\Approveduser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DateTime;
use Session;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_types_id','=','2')
        ->orWhere('user_types_id','=','1')->paginate(8);
        $usertype = UserType::all();
        $scopeperformed= ScopePerformed::all();

        return view('user.index',[
                    'users'          => $users, 
                    'usertype'       => $usertype,
                    'scopeperformed' => $scopeperformed,
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
        
    }
    public function dashboard()
    {

        $associate = User::where('user_types_id','=','2')->count();
        $schedular = User::where('user_types_id','=','1')->count();
        $project = Project::all()->count();
        $projectbid = ProjectBid::all()->count();
        $users = User::where('user_types_id','=','2')
        ->where('users_approval_status','=','2')->paginate(8);
        return view('dashboard',[
        'associate'    => $associate, 
        'schedular'    => $schedular,
        'project'      => $project,
        'projectbid'   => $projectbid,
        'users'        => $users,
        ]);
    }
    public function approveduser($id,$status,Request $request)
    {
        $adminid = session('loginuserid');
        $date    = date("Y-m-d H:i:s");
        $associatetype =  $request->input('optradio');
        User::where('users_id', $id)
        ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date,'associate_type_id' => $associatetype]);
       
        if($status == 1)
        {
            $user=User::where('users_id',$id)->first();
            $useremail = $user->users_email;
            Mail::to($useremail)->send(new Approveduser($user));
        }
        session()->flash('message', 'Approval status has been updated successfully');
        return redirect()->action('UserController@dashboard');

    }
    public function search(Request $request)
    {
        $approval_status = $request->status;
        $users = User::where('users_approval_status', $approval_status)->paginate(8);
        $usertype = UserType::all();
        return view('admin.user',[
                    'users'     => $users,
                    'usertype'  => $usertype,
                   ]);
    }
    public function adminuser()
    {
        $users    = User::where('user_types_id','=','4')->paginate(8);
        $usertype = UserType::all();
        $admin    = 4;
        return view('user.index',[
                    'users'       => $users, 
                    'usertype'    => $usertype,
                    'admin'       => $admin,
                  ]);
       
    }
    


}
