<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScopePerformed extends Model
{
    /*$row = "2,4,5";
    $idsArr = explode(',',$row);  
    DB::table('stories')->whereIn('author',$idsArr)->get();
*/
    protected $table      = 'user_scope_performed';
    protected $primaryKey = 'user_scope_performed_id'; 
    protected $fillable   = ['users_id','scope_performed_id'];
    public $timestamps    = false; 
   
}
