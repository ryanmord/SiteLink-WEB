<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssociateType extends Model
{
    protected $table      = 'associate_type';
    protected $primaryKey = 'associate_type_id';
	protected $fillable   = ['associate_type_id','associate_type'];
	public $timestamps    = false; 
}
