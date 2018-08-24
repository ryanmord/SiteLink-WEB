<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $primaryKey = 'project_id';
   protected $fillable = [
   		'project_name','project_site_address','report_due_date','instructions','approx_bid','project_created_date','project_updated',
   ];
   public function projectstatustype()
    {
        return $this->belongsToMany('App\ProjectStatusType','project_status','project_id','project_status_type_id');
    }
    public function scopeperformed()
    {
        return $this->hasMany('App\ScopePerformed','scope_performed_id');
    }

}
