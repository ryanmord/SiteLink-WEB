<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectNotificationType extends Model
{
    protected $table      = 'project_notification_type';
    protected $primaryKey = 'project_notification_type_id'; 
    protected $fillable   = ['project_notification_type_id','project_notification_type'];
    public $timestamps    = false; 
}
