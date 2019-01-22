<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\UserReview;
use App\Project;
use App\ProjectBid;
class UserReviewController extends Controller
{
   public function rating()
   {
   		return view('project.rating');
   }
   public function managerReviewStore(Request $request)
   {
		  $rating = $request->input('rating');
   		$comment = $request->input('comment');
   		$projectid = $request->input('projectid');
   		$userid = session('loginuserid');
   		if(isset($request['rating']))
        {
        	$projectbid = ProjectBid::where('project_id','=',$projectid)
   								->where('project_bid_status','=',1)
   								->where('bid_status','=',1)
   								->first();
       		$touserid = $projectbid->user_id;
          $text = 'New Rating given by Manager!';
			    $review = new UserReview;
          $review->from_user_id = (int)$userid;
          $review->to_user_id = $touserid;
          $review->project_id = (int)$request['projectid'];
          $review->user_review_ratings = (double)$request['rating'];
          if(isset($request['comment']))
          {
            $review->user_review_comments = $request['comment'];
          }
          $review->save();
          $notificationid = '11';
          $project = Project::where('project_id','=',$projectid)->first();
          $body = $project->project_name;
          $title = $text;
          $apiobj = new ApiController;
			    $apiobj->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
          $temp = array('status' => '1','message' => "User review submmited successfully");
          return response()->json($temp);
          exit;
        }
        else
        {
        	$temp = array('status' => '0', 'message' => "Mandatory field is required");
          return response()->json($temp);
          exit;
        }

   }
   public function associateReviewStore(Request $request)
   {
      $rating = $request->input('rating');
      $comment = $request->input('comment');
      $projectid = $request->input('projectid');
      $userid = session('associateId');
      if(isset($request['rating']))
        {
            $project = Project::where('project_id','=',$projectid)->first();
            $touserid = $project->user_id;
            $text = 'New Rating given by Associate!';
            $review = new UserReview;
            $review->from_user_id = (int)$userid;
            $review->to_user_id = $touserid;
            $review->project_id = (int)$request['projectid'];
            $review->user_review_ratings = (double)$request['rating'];
            if(isset($request['comment']))
            {
                $review->user_review_comments = $request['comment'];
            }
            $review->save();
            $notificationid = '11';
            $project = Project::where('project_id','=',$projectid)->first();
            $body = $project->project_name;
            $title = $text;
            $apiobj = new ApiController;
            $apiobj->sendUserNotification($touserid,$userid,$projectid,$body,$title,$text,$notificationid);
            $temp = array('status' => '1','message' => "User review submmited successfully");
            return response()->json($temp);
            exit;
        }
        else
        {
          $temp = array('status' => '0', 'message' => "Mandatory field is required");
          return response()->json($temp);
          exit;
        }

   }
}
