<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminForgotPassword extends Model
{
    protected $table      = 'admin_forgot_password';
    protected $primaryKey = 'admin_forgot_password_id';
    protected $fillable   = [
    'admin_users_id',
    'request_date',
    'password_updated_flag',
    'updated_at'
    ];
    public $timestamps    = false; 
}
