<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatusType extends Model
{
    protected $primaryKey = 'project_status_type_id';
	protected $table      = 'project_status_type';
    public function projects()
    {
        return $this->belongsToMany('App\Project','project_status','project_id','project_status_type_id');
    }
    
}
