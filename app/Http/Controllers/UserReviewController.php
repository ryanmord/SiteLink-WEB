<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserReview;
class UserReviewController extends Controller
{
   public function rating()
   {
   		return view('project.rating');
   }
   public function store(Request $request)
   {
   		$rating = $request->input('rating');
   		$comment = $request->input('comment');
   }
}
