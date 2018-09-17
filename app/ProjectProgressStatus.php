<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectProgressStatus extends Model
{
    protected $table = 'project_progress_status';
   	protected $primaryKey = 'project_progress_status_id';
    protected $fillable = ['project_id','user_id','project_progress_status_subject','project_progress_status','created_at','updated_at'];
    //public $timestamps = false;
}
