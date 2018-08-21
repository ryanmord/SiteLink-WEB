<?php

namespace App\Http\Controllers;
use App\User;
use App\UserType;
use App\AdminUser;
use Illuminate\Http\Request;
use DateTime;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_types_id','=','2')->orWhere('user_types_id','=','1')->paginate(8);
        $usertype = UserType::all();

        return view('user.index',[
                    'users'       => $users, 
                    'usertype'    => $usertype,
                  ]);
       
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
    public function dashboard()
    {

    $associate = User::where('user_types_id','=','2')->count();
    $schedular = User::where('user_types_id','=','1')->count();
    $users = User::where('user_types_id','=','2')
    ->where('users_approval_status','=','2')->paginate(8);
    return view('dashboard',[
    'associate'    => $associate, 
    'schedular'    => $schedular,
    'users'        => $users,
    ]);
    }
    public function approveduser($id,$status)
    {
       $adminid=session('loginuserid');
        $date=date("Y-m-d H:i:s");  
        User::where('users_id', $id)
            ->update(['users_approval_status' => $status,'users_approved_by' => $adminid,'users_approved_date' => $date]);
        Session::flash('flash_message', 'Record has been updated successfully');
       return redirect()->action('UserController@dashboard');

    }
   /* public function getAjax()
    {
        $id = $_GET['id'];
        $test = new TestModel();
        $result = $test->getData($id);

        foreach($result as $row)
        {
            $html =
              '<tr>
                 <td>' . $row->name . '</td>' .
                 '<td>' . $row->address . '</td>' .
                 '<td>' . $row->age . '</td>' .
              '</tr>';
        }
        return $html;
    }*/
    public function search(Request $request)
    {
        $approval_status = $request->status;
        $users = User::where('users_approval_status', $approval_status)->paginate(8);
        $usertype = UserType::all();
        return $users;
     /*foreach($users as $row)
    {
        $html[] =
              '<tr>
                <td>' . $row->users_profile_image . '</td> .
                 <td>' . $row->users_name . '</td>' .
                 '<td>' . $row->users_company . '</td>' .
                 
              '</tr>';
    }
    return $html;*/

        /*$view = view('user.index',[
                    'users'       => $users, 
                    'usertype'    => $usertype,
                  ]);


    return response()->json(['success' => true, 'html' => $view]);
       */
        /*return url('compare');*/
    }
    public function adminuser()
    {
        $users = User::where('user_types_id','=','4')->paginate(8);
        $usertype = UserType::all();
        $admin=1;
        return view('user.index',[
                    'users'       => $users, 
                    'usertype'    => $usertype,
                    'admin'       => $admin,
                  ]);
       
    }
    


}
