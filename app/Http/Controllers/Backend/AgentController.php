<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\Admin;

class AgentController extends Controller
{
    //
    public function user(Request $request)
    {
    	return view('Backend.Agent.user');
    }

    public function getAgentsAjax()
    {
    	return Admin::where([
            ['role_id', '=', Role::AGENT_ID],
            ['is_deleted', '=', Admin::NOT_DELETED],
        ])->paginate();
    }

    public function getAgentGroupAjax()
    {
        return Admin::where([
            ['role_id', '=', Role::AGENT_ID],
            ['is_deleted', '=', Admin::NOT_DELETED],
        ])->get()->toArray();
    }

	public function createOrUpdateAgentAjax(Request $request)
	{
		if($request->id){ //更新
            $admin = Admin::find($request->id);
            $admin->updated_at = date('Y-m-d H:i:s');
            $admin->updated_by = session('admin')['name'];
            if($request->admin_passwd != $admin->admin_passwd){
                if($request->admin_passwd != $request->admin_passwd_confirm)
                    return [false, '两次输入的密码不一致！'];
                $admin->admin_passwd = Hash::make($request->admin_passwd);
            }
        }else{ //插入
            $admin = new Admin;
            $admin->created_at = date('Y-m-d H:i:s');
            $admin->created_by = session('admin')['name'];
            $admin->admin_passwd = Hash::make($request->admin_passwd);
        }
        
        $admin->role_id = Role::AGENT_ID;
        $admin->admin_name = $request->admin_name;
        $admin->is_enabled = $request->is_enabled?1:0;
        $admin->is_deleted = $request->is_deleted?:0;
        $admin->save();

        return [true, '操作成功！'];
	}

    public function deleteAgentAjax(Request $request)
    {
        Admin::where('id', $request->id)->update(['is_deleted' => Admin::DELETED]);
        return [true, '已删除！'];
    }

}
