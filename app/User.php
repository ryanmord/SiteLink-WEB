<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'users_id';
    protected $fillable = [
        'users_name', 'users_email', 'users_password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'users_password', 'remember_token',
    ];
     
    public function usertype()
    {
        return $this->hasOne('App\UserType', 'user_types_id', 'user_types_id');
    }
    public function adminuser()
    {
        return $this->hasOne('App\AdminUser', 'admin_users_id', 'users_approved_by');
    }
    public function scopeperformed()
    {
        return $this->belongsToMany('App\ScopePerformed','user_scope_performed','users_id','scope_performed_id');
    }
}
