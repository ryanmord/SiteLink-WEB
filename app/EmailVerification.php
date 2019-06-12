<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $table      = 'email_verification';
    protected $primaryKey = 'email_verification_id'; 
    protected $fillable   = ['user_id','verification_code','status','created_at'];
    public $timestamps    = false; 
}
