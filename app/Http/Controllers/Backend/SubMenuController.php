<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubMenu;
use App\Models\Role;

class SubMenuController extends Controller
{
    public function index()
    {
    	return view('Backend.Setting.sub_menu');
    }

    public function getAllSubMenuAjax(Request $request){
    	return SubMenu::all()->toArray();
    }

    public function createOrUpdateAjax(Request $request){
        if($request->id){ //更新
            $subMenu = SubMenu::find($request->id);
            $subMenu->updated_at = date('Y-m-d H:i:s');
            $subMenu->updated_by = session('admin')['name'];
        }else{ //插入
            $subMenu = new SubMenu;
            $subMenu->created_at = date('Y-m-d H:i:s');
            $subMenu->created_by = session('admin')['name'];
        }
        
        $subMenu->mm_id = $request->mm_id;
        $subMenu->sm_name = $request->sm_name;
        $subMenu->sm_desc = $request->sm_desc;

        $subMenu->save();

        return [true, '操作成功！'];
    }
}