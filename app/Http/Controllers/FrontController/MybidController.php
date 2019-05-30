<?php

namespace App\Http\Controllers\FrontController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FrontController\ProjectController;
use App\User;
use App\ScopePerformed;
use Illuminate\Support\Facades\Validator;
class MybidController extends Controller
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
        $activeBids = $apiobj->activeBids($request);
        $activeBids = json_decode($activeBids, true);
        /*print_r($activeBids);
        exit;*/
        if($activeBids['status'] == 1)
        {
            $activeBidProject = $activeBids['mybids'];
            $request['projectid'] = $activeBidProject[0]['projectid'];
            $request['callFunction'] = 1;
            $projectobj = new ProjectController;
            $activeProjectDetail = $projectobj->show($request);
        }
        $historyBids = $apiobj->bidHistory($request);
        $historyBids = json_decode($historyBids, true);
        if($historyBids['status'] == 1)
        {
            $historyBidProject = $historyBids['mybids'];
            $request['projectid'] = $historyBidProject[0]['projectid'];
            //for calling function 
            $request['callFunction'] = 1;
            $projectobj = new ProjectController;
            $historyProjectDetail = $projectobj->show($request);
            
        }
        if(!isset($activeProjectDetail))
        {
            $activeProjectDetail = null;
        }
        if(!isset($historyProjectDetail))
        {
            $historyProjectDetail = null;
        }
        return view('frontview.projects.mybids',['activeBidProject' => $activeBids,
                                        'activeProjectDetail'       => $activeProjectDetail,
                                        'historyBidProject'         => $historyBids,
                                        'historyProjectDetail'      => $historyProjectDetail,
                                        ]);
        
    }
    public function searchBidHistory(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        $searchKeyword = $request['search_keyword'];
        $bidHistoryProject = $apiobj->bidHistory($request,$searchKeyword);
        $bidHistoryProject = json_decode($bidHistoryProject, true);
        //echo "<pre>"; print_r($availableProject['status']); exit;
        $projectobj = new ProjectController;
        if($bidHistoryProject['status'] == 1)
        {
            $projects = $bidHistoryProject['mybids'];
            $request['projectid'] = $projects[0]['projectid'];
            
            $request['callFunction'] = 1;
            $projectdetail = $projectobj->show($request);
        }
        if(!isset($projectdetail))
        {
            $projectdetail = null;
        }
        if(!isset($manager))
        {
            $manager = null;
        }

        $appendLi = "";
        if (!empty($bidHistoryProject)) {

            if (!empty($bidHistoryProject['mybids'])) {
                $appendLi = '';
                $i = 1;
                foreach ($bidHistoryProject['mybids'] as $k => $value) {
                    if($i == 1){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" >
                                        <a href="#historyProjectDetail" class ="active odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }
                    elseif($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#historyProjectDetail" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#historyProjectDetail" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }                
                    ++$i;
                }
            }
        }
        $temp = array('appendLi'             => $appendLi,
                      'projectdetail'        => $projectdetail,
                     
                    );

        return response()->json($temp);
    }
    public function searchActiveBids(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = 1;
        $request['limit'] = 10;
        $searchKeyword = $request['search_keyword'];
        $activeBidProjects = $apiobj->activeBids($request,$searchKeyword);
        $activeBidProjects = json_decode($activeBidProjects, true);
        //echo "<pre>"; print_r($availableProject['status']); exit;
        $projectobj = new ProjectController;
        if($activeBidProjects['status'] == 1)
        {
            $projects = $activeBidProjects['mybids'];
            $request['projectid'] = $projects[0]['projectid'];
            
            $request['callFunction'] = 1;
            $projectdetail = $projectobj->show($request);
        }
        if(!isset($projectdetail))
        {
            $projectdetail = null;
        }
        if(!isset($manager))
        {
            $manager = null;
        }
        $appendLi = "";
        if (!empty($activeBidProjects)) {

            if (!empty($activeBidProjects['mybids'])) {
                $appendLi = '';
                $i = 1;
                foreach ($activeBidProjects['mybids'] as $k => $value) {
                    if($i == 1){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'" >
                                        <a href="#historyProjectDetail" class ="active odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }
                    elseif($i %2 == 0){
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#historyProjectDetail" class ="even" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }else{
                        $appendLi .= '<li value="'.$value['projectid'].'" id="'.$value['projectid'].'">
                                        <a href="#historyProjectDetail" class ="odd" data-toggle="tab">'.$value['projectname'].'<i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>';
                    }                
                    ++$i;
                }
            }
        }
        $temp = array('appendLi'             => $appendLi,
                      'projectdetail'        => $projectdetail,
                     
                    );

        return response()->json($temp);
    }
     public function activeBidPagination(Request $request){
        $apiobj = new ApiController;
        $request['userid'] = session('associateId');
        $request['privatekey'] = 1;
        $request['pagenumber'] = $request['pagenumber'];
        $search_keyword = $request['search_keyword'];
        $request['limit'] = 10;
        $activeBidProjects = $apiobj->availableProject($request,$search_keyword);
        $activeBidProjects = json_decode($activeBidProjects, true);
        $appendLi = "";
        if($activeBidProjects['status'] == 1) {

            if (!empty($activeBidProjects['publishprojects'])) {
                $i = 1;
                foreach ($activeBidProjects['publishprojects'] as $k => $value) {
                   
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
    public function edit()
    {
        
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
}
