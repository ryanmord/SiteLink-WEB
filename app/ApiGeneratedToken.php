<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiGeneratedToken extends Model
{
    protected $table      = 'api_generated_token';
    protected $primaryKey = 'api_generated_token_id';
	protected $fillable   = ['api_generated_token_id','api_generated_token','status','created_at'];
	public $timestamps    = false; 
}
