<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectBidRequest extends Model
{
    protected $table      = 'project_bid_request';
    protected $primaryKey = 'project_bid_request_id'; 
    protected $fillable   = ['project_id','from_user_id','to_user_id','bid_request_status','created_at'];
    public $timestamps    = false; 
}
