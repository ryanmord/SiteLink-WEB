<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectNotification extends Model
{
    protected $table = 'project_notification';
    protected $primaryKey = 'project_notification_id'; 
    protected $fillable = ['project_notification_type_id','project_id','notification_text','from_user_id','to_user_id','read_flag','created_at','notification_read_at'];
    public $timestamps = false; 
}
