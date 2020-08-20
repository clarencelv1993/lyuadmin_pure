<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\MainMenu;
use App\Models\SubMenu;

class SettingController extends Controller
{
    public function role()
    {
        return view('Backend.Setting.role');
    }

    public function getRolesAjax(Request $request){
        $roles = Role::where('is_deleted', Role::NOT_DELETED)->get()->toArray();
        return $roles;
    }

    public function createOrUpdateRoleAjax(Request $request){
        if($request->id){ //更新
            $role = Role::find($request->id);
            $role->updated_at = date('Y-m-d H:i:s');
            $role->updated_by = session('admin')['name'];
        }else{ //插入
            $role = new Role;
            $role->created_at = date('Y-m-d H:i:s');
            $role->created_by = session('admin')['name'];
        }
        
        $role->role_name = $request->role_name;
        $role->role_desc = $request->role_desc;
        $role->role_permission = json_encode($request->role_permission);
        $role->is_enabled = $request->is_enabled?1:0;
        $role->is_deleted = $request->is_deleted;
        $role->save();

        return [true, '操作成功！'];
    }

    public function deleteRoleAjax(Request $request)
    {
        Role::where('id', $request->id)->update(['is_deleted' => Role::DELETED]);
        return [true, '已删除！'];
    }

    public function getRolePermissionAjax(Request $request){
        $subMenus = $request->subMenus;
        return SubMenu::whereIn('id', $subMenus)->where('is_deleted', SubMenu::NOT_DELETED)->get('sm_desc')->toArray();
    }

    public function main_menu()
    {
        return view('Backend.Setting.main_menu');
    }

    public function getMainMenusAjax(Request $request){
        return MainMenu::where('is_deleted', MainMenu::NOT_DELETED)->orderBy('order', 'ASC')->paginate($request->size);
    }

    public function getMainMenusArrayAjax(Request $request){
        return MainMenu::where('is_deleted', MainMenu::NOT_DELETED)->orderBy('order', 'ASC')->get();
    }

    public function createOrUpdateMainMenuAjax(Request $request){
        if($request->id){ //更新
            $mainMenu = MainMenu::find($request->id);
            $mainMenu->updated_at = date('Y-m-d H:i:s');
            $mainMenu->updated_by = session('admin')['name'];
        }else{ //插入
            $mainMenu = new MainMenu;
            $mainMenu->created_at = date('Y-m-d H:i:s');
            $mainMenu->created_by = session('admin')['name'];
        }
        
        $mainMenu->mm_icon = $request->mm_icon;
        $mainMenu->mm_name = $request->mm_name;
        $mainMenu->mm_desc = $request->mm_desc;
        $mainMenu->order = $request->order;

        $mainMenu->save();

        return [true, '操作成功！'];
    }

    public function deleteMainMenuAjax(Request $request)
    {
        MainMenu::where('id', $request->id)->update(['is_deleted' => MainMenu::DELETED]);
        return [true, '已删除！'];
    }

    public function sub_menu()
    {
        return view('Backend.Setting.sub_menu');
    }

    public function getSubMenusAjax(Request $request){
        return SubMenu::where('is_deleted', SubMenu::NOT_DELETED)->with('mainMenu')->paginate($request->size);
    }

    public function getSubMenusArrayAjax(Request $request){
        return SubMenu::where('is_deleted', SubMenu::NOT_DELETED)->with('mainMenu')->get()->toArray();
    }

    public function createOrUpdateSubMenuAjax(Request $request){
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

    public function deleteSubMenuAjax(Request $request)
    {
        SubMenu::where('id', $request->id)->update(['is_deleted' => SubMenu::DELETED]);
        return [true, '已删除！'];
    }

}
