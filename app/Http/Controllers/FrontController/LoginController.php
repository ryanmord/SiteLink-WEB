<?php

namespace App\Http\Controllers\FrontController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\ScopePerformed;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //use IsAssociate;

    //protected $redirectTo = route('AssociateLogin');
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('frontview.auth.login');
    }
    public function signUp()
    {
        $scope = ScopePerformed::all();
        return view('frontview.auth.signup',['scope' => $scope]);
        
    }
    public function login(Request $request)
    {
        $request['email']    = $request['login_email'];
        $request['password'] = $request['login_password'];
        $this->validate($request, [
                        'login_email'    => 'required|email',
                        'login_password' => 'required',
                    ]);
        $request['callFrom'] = 1;
        $apiobject = new ApiController();
        $login = $apiobject->userlogin($request);
        $login = json_decode($login, true);
        if($login['status'] == '1')
        {
            session(['associateId'     => $login['userid']]);
            session(['associateName'   => $login['username']]);
            session(['profileImage'    => $login['profileImage']]);
            session(['associateTypeId' => $login['associateTypeId']]);
            return response()->json($login);
            exit;
        }
        else
        {
            return response()->json($login);
            exit;
        }
    }
    public function dashboard()
    {

        $request = new Request;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $apiobject = new ApiController;
        $temp = $apiobject->dashboard($request);
        $temp = json_decode($temp, true);
        $completedpercentage = $temp['completedpercentage'];
        $percentage = round($completedpercentage);
        $reminder = $percentage % 10;
        if($reminder < 5)
        {
            $percentage = $percentage - $reminder;
        }
        else
        {
            $percentage = ($percentage - $reminder) + 10;
        }
        $request['pagenumber'] = 1;
        $request['limit'] = 4;
        $notificationlist = $apiobject->notificationList($request);
        $notificationlist = json_decode($notificationlist, true);
        $datastatus = $notificationlist['status'];
        return view('frontview.dashboard.home',['user'         => $temp,
                                                'percentage'   => $percentage,
                                                'notification' => $notificationlist,
                                                'datastatus'   => $datastatus]);
    }
    public function notificationPagination(Request $request)
    {
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $request['limit'] = 4;
        $notificationlist = $apiobj->notificationlist($request);
        $notificationlist = json_decode($notificationlist, true);
        $appendLi = "";
        if($notificationlist['status'] == 1) {


            if (isset($notificationlist['notification'])) {
                $i = 1;
                
                foreach ($notificationlist['notification'] as  $value) {
                   
                    if($i % 2 == 0)
                    {
                        $appendLi .= '<li class="even">';
                    }
                    else
                    {
                        $appendLi .= ' <li class="odd">';
                    }

                    if($value['readflag'] == 0)
                    {

                        $appendLi .= '<span><i class="fa fa-circle" style="color: #fe5f55;float: left;"></i><h5>&nbsp'.$value['projectname'].'</h5><div class="notification-date">'.$value['createddate'].'</div></span>';
                    }
                    else
                    {
                        $appendLi .= '<span><h5>&nbsp'.$value['projectname'].'</h5>
                        <div class="notification-date">'.$value['createddate'].'</div></span>';
                    }
                    $appendLi .= '<p> &nbsp'.$value['notificationtext'].'</p>';

                    //1 for when new project is created nearby associate area then he can add bid for new project

                    if($value['notificationflag'] == 1)
                    {
                        if($value['statusflag'] == 1)
                        {

                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" data-id="" notification-id="'.$value['notificationid'].'">';
                        }
                        else
                        {
                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add bid" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                        }
                    }
                   
                   //3 for when bid is accepted then associate can enter the status

                    elseif($value['notificationflag'] == 3)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Note" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }

                    //4 for reject bid then associate can apply bid again

                    elseif($value['notificationflag'] == 4)
                    {
                        if($value['statusflag'] == 1)
                        {

                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" data-id="" notification-id="'.$value['notificationid'].'">';
                        }
                        else
                        {
                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add bid" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                        }
                    }

                    //6 for Schedular updated project details and asscoiate can add new bid 
                    
                    elseif($value['notificationflag'] == 6)
                    {
                        if($value['statusflag'] == 1)
                        {

                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View project" onclick="alertfunction()" data-id="" notification-id="'.$value['notificationid'].'">';
                        }
                        else
                        {
                            $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View project" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                        }
                    }

                    //7 for when project manager complete the project

                    elseif($value['notificationflag'] == 7)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View Project" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }

                    //8 for when project manager complete the project

                    elseif($value['notificationflag'] == 8)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View project" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }

                    //11 for when project manager gives rating and review to associate 

                    elseif($value['notificationflag'] == 11)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Rating" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }

                    //12 for when project manager add any note to the project

                    elseif($value['notificationflag'] == 12)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View Note" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }


                   //13 for when project do the project in on hold

                    elseif($value['notificationflag'] == 13)
                    {
                       $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View project" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
                    }

                    //14 for when project do the project in progress

                    elseif($value['notificationflag'] == 14)
                    {
                        $appendLi .= '<input type="button" name="viewProjectbtn"  class="noti-btn" value="View project" onclick="viewprojectdetail('.$value['projectid'].','.$value['notificationid'].')">';
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
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('AssociateLogin');
    }
    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
                        'email' => 'required',
                        ]);
        $request['email'] = $request['email'];
        $object = new ApiController;
        $response = $object->forgotpassword($request);
        $response = json_decode($response, true);
        return response()->json($response);
        exit;
    }
}
