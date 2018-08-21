<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScopePerformed extends Model
{
	 protected $primaryKey = 'scope_performed_id';
	protected $table = 'scope_performed';
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
