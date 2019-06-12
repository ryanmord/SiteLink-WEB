<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectBid extends Model
{
    protected $table      = 'project_bids';
    protected $primaryKey = 'project_bid_id';
	protected $fillable   = ['user_id','project_id','is_employee','associate_suggested_bid','project_bid_status','created_at','accepted_rejected_at','bid_status'];
	public $timestamps    = false; 
	public function user()
    {
        return $this->hasOne('App\User', 'users_id','user_id');
    }
    public function projectstatustype()
    {
        return $this->belongsToMany('App\ProjectStatusType','project_status','project_id','project_status_type_id');
    }
}
