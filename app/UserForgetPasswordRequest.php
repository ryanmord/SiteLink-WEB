<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForgetPasswordRequest extends Model
{
    protected $table      = 'user_forget_password_request';
    protected $primaryKey = 'user_forget_password_request_id';
    protected $fillable   = [
    'users_id',
    'request_date',
    'password_updated_flag',
    'password_updated_date'
    ];
    public $timestamps    = false; 
}
