<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    //
	const DELETED = 1;
	const NOT_DELETED = 0;

    protected $table = 'main_menu';

    public $timestamps = false;

    public function subMenu()
    {
        return $this->hasMany('App\Models\SubMenu', 'mm_id', 'id');
    }
}
