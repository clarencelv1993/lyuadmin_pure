<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\Admin;
use App\Models\MainMenu;
use App\Models\SubMenu;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	return view('Backend.Home.dashboard');
    }

    public function signIn(Request $request)
    {
    	$request->session()->forget(['admin']);
    	return view('Backend.Home.sign_in');
    }

    public function signOut(Request $request)
    {
    	$request->session()->forget(['admin']);
    	return view('Backend.Home.sign_in');
    }

    public function signInAjax(Request $request)
    {
        //用户名匹配
        $admin = Admin::where('admin_name', $request->admin_name)->first();
        $role_is_enabled = Role::find($admin->role_id)->is_enabled;
        if(!$role_is_enabled)
            return [false, '该用户所属角色已被禁用'];
        if(!$admin)
            return [false, '管理员不存在'];
        if($admin && !Hash::check($request->admin_passwd, $admin->admin_passwd))
            return [false, '管理员密码错误'];

        $menus = $this->getAdminMenu($admin->id);
        $request->session()->put('admin', [
            'id' => $admin->id,
            'name' => $admin->admin_name,
            'menus' => $menus,
        ]);
        return [true, '登录成功'];
    }

    public function getAdminMenu($admin_id)
    {
        $permission = Admin::find($admin_id)->role->role_permission;
        $menus = MainMenu::with(['subMenu' => function($query) use ($permission){
        	$query->whereIn('id', $permission)->where('is_deleted', SubMenu::NOT_DELETED)->orderBy('order', 'ASC')->get(['mm_id', 'id', 'sm_name', 'sm_desc']);
        }])->where('is_deleted', MainMenu::NOT_DELETED)->orderBy('order', 'ASC')->get(['id', 'mm_name', 'mm_desc', 'mm_icon'])->toArray();
        return $menus;
    }
    
}
