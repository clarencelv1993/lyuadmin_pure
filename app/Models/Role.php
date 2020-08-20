<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ENABLED = 1;
    const NOT_ENABLED = 0;
	const DELETED = 1;
	const NOT_DELETED = 0;
	const ROOT_ID = 1;
	const ADMIN_ID = 2;
	const AGENT_ID = 3;
    
    //
    protected $table = 'role';

    public $timestamps = false;

    public function getRolePermissionAttribute($value){
        $role_permission = json_decode($this->attributes['role_permission'], true);
        return $role_permission;
    }

    public function getIsEnabledAttribute($value){
        $is_enabled = $this->attributes['is_enabled']?true:false;
        return $is_enabled;
    }
}
