<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $primaryKey = 'project_id';
   protected $fillable   = [
   		                       'project_name','user_id','project_site_address','report_due_date','instructions','approx_bid','report_template','scope_performed_id','qaqc_date','created_at','updated_at','created_by'
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
