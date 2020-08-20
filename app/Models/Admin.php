<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    const ENABLED = 1;
    const NOT_ENABLED = 0;
	const DELETED = 1;
	const NOT_DELETED = 0;

    protected $table = 'admin';
    
    public $timestamps = false;

    public function getIsEnabledAttribute($value){
        $is_enabled = $this->attributes['is_enabled']?true:false;
        return $is_enabled;
    }

    public function role()
	{
	    return $this->belongsTo('App\Models\Role', 'role_id', 'id');
	}
}
