<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccessKey extends Model
{
   	protected $table = 'user_access_key';
   	protected $primaryKey = 'user_access_key_id';
    protected $fillable = ['user_access_key','user_id','user_device_id','user_access_key_status','user_access_key_generated','logout_status','logout_datetime'];
    public $timestamps = false; 
   
}
