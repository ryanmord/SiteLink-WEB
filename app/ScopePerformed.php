<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScopePerformed extends Model
{
	protected $primaryKey = 'scope_performed_id';
	protected $table = 'scope_performed';
	 protected $fillable = [
        'scope_performed_id', 'scope_performed', 'scope_status',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function projects()
    {
    	return $this->hasOne('App\Project','scope_performed_id','scope_performed_id');
    }
}
