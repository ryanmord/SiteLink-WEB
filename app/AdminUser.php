<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'admin_users_id';
    protected $fillable   = [
                            'admin_users_email',
                            'admin_users_password'
                            ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
                            'admin_users_password','remember_token',
                        ];
     public function user()
    {
        return $this->hasOne('App\User', 'users_approved_by');
    }
}
