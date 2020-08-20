<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    //
	const DELETED = 1;
	const NOT_DELETED = 0;

    protected $table = 'sub_menu';

    public $timestamps = false;

    public function mainMenu()
    {
        return $this->belongsTo('App\Models\MainMenu', 'mm_id', 'id');
    }
}
