<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
	protected $primaryKey = 'user_types_id';
    protected $fillable   = [
   								'user_types',
   							];
   public function user()
    {
        return $this->hasOne('App\User', 'user_types_id');
    }
}
