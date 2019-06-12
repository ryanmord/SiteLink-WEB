<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
   	protected $table      = 'user_reviews';
    protected $primaryKey = 'user_review_id'; 
    protected $fillable   = ['from_user_id','to_user_id','project_id','created_at','user_review_ratings','user_review_comments'];
    //public $timestamps    = false; 
}
