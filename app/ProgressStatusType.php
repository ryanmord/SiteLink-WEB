<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressStatusType extends Model
{
    protected $primaryKey = 'progress_status_type_id';
	protected $table      = 'progress_status_type';
	protected $fillable  = [
        'progress_status_type_id', 'progress_status_type',
    ];
}
