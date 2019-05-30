<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $table      = 'user_device';
    protected $primaryKey = 'user_device_id'; 
    protected $fillable   = ['user_id','user_device_type','user_device_unique_id','user_device_registered_on'];
    public $timestamps    = false; 
   
}
