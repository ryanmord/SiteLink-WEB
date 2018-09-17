<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'setting_id'; 
    protected $fillable = ['min_miles','max_miles','setting_status','created_at'];
    public $timestamps = false; 
   
}
