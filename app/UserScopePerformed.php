<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScopePerformed extends Model
{
    /*$row = "2,4,5";
    $idsArr = explode(',',$row);  
    DB::table('stories')->whereIn('author',$idsArr)->get();
*/
    protected $table = 'user_scope_performed';
    public function userscope()
    {
        return $this->hasOne('App\User', 'users_id', 'users_id');
    }

}
