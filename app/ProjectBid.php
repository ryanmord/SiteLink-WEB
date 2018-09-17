<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectBid extends Model
{
    protected $table = 'project_bids';
    protected $primaryKey = 'project_bid_id';
	protected $fillable   = ['user_id','project_id','associate_suggested_bid','project_bid_status','created_at','bid_accepted_rejected_at','bid_status'];
	public $timestamps = false; 
}
