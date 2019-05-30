<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectNotificationSentDevice extends Model
{
    protected $table      = 'project_notification_sent_device';
    protected $fillable   = ['project_notification_id','user_device_id','notification_sent'];
    public $timestamps    = false; 
}
