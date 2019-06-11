<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
	protected $table      = 'project_status';
    protected $primaryKey = 'project_status_id';
    protected $fillable   = [
    						'project_id',
    						'project_status_type_id',
    						'created_at'
    						];
    public $timestamps    = false; 
    
}
