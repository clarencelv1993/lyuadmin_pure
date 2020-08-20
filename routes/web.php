<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Backend\HomeController@index')->middleware('web', 'check.admin.session');


Route::prefix('home')->group(function () {
    Route::get('/', 'Backend\HomeController@index')->middleware('web');
    Route::get('sign_in', 'Backend\HomeController@signIn')->middleware('web');
    Route::get('sign_out', 'Backend\HomeController@signOut')->middleware('web');
    Route::post('sign_in_ajax', 'Backend\HomeController@signInAjax')->middleware('web');
    Route::get('get_active_menu_ajax', 'Backend\HomeController@getActiveMenuAjax')->middleware('web');
    
});

Route::middleware('web', 'check.admin.session')->prefix('setting')->group(function () {
    //角色权限
    Route::get('role', 'Backend\SettingController@role')->middleware('active.menu');
    Route::get('get_roles_ajax', 'Backend\SettingController@getRolesAjax');
    Route::post('get_role_permission_ajax', 'Backend\SettingController@getRolePermissionAjax');
    Route::post('create_or_update_role_ajax', 'Backend\SettingController@createOrUpdateRoleAjax');
    Route::post('delete_role_ajax', 'Backend\SettingController@deleteRoleAjax');

    //主菜单
    Route::get('main_menu', 'Backend\SettingController@main_menu')->middleware('active.menu');
    Route::get('get_main_menus_ajax', 'Backend\SettingController@getMainMenusAjax');
    Route::get('get_main_menus_array_ajax', 'Backend\SettingController@getMainMenusArrayAjax');
    Route::post('create_or_update_main_menu_ajax', 'Backend\SettingController@createOrUpdateMainMenuAjax');
    Route::post('delete_main_menu_ajax', 'Backend\SettingController@deleteMainMenuAjax');

    //子菜单
    Route::get('sub_menu', 'Backend\SettingController@sub_menu')->middleware('active.menu');
    Route::get('get_sub_menus_ajax', 'Backend\SettingController@getSubMenusAjax');
    Route::get('get_sub_menus_array_ajax', 'Backend\SettingController@getSubMenusArrayAjax');
    Route::post('create_or_update_sub_menu_ajax', 'Backend\SettingController@createOrUpdateSubMenuAjax');
    Route::post('delete_sub_menu_ajax', 'Backend\SettingController@deleteSubMenuAjax');

});

Route::middleware('web', 'check.admin.session')->prefix('member')->group(function () {
    //会员管理
    Route::get('user', 'Backend\MemberController@user')->middleware('active.menu');
    Route::get('get_users_ajax', 'Backend\MemberController@getUsersAjax');
    Route::post('create_or_update_user_ajax', 'Backend\MemberController@createOrUpdateUserAjax');
    Route::post('ban_ajax', 'Backend\MemberController@banAjax');
    Route::post('unban_ajax', 'Backend\MemberController@unbanAjax');

    //会员层级
    Route::get('level', 'Backend\MemberController@level')->middleware('active.menu');
    Route::get('get_levels_ajax', 'Backend\MemberController@getLevelsAjax');
    Route::post('create_or_update_level_ajax', 'Backend\MemberController@createOrUpdateLevelAjax');
    Route::post('delete_level_ajax', 'Backend\MemberController@deleteLevelAjax');
});

Route::middleware('web', 'check.admin.session')->prefix('agent')->group(function () {
    //代理列表
    Route::get('user', 'Backend\AgentController@user')->middleware('active.menu');
    Route::get('get_agents_ajax', 'Backend\AgentController@getAgentsAjax');
    Route::get('get_agent_group_ajax', 'Backend\AgentController@getAgentGroupAjax');
    Route::post('create_or_update_agent_ajax', 'Backend\AgentController@createOrUpdateAgentAjax');
    Route::post('delete_agent_ajax', 'Backend\AgentController@deleteAgentAjax');
});

Route::middleware('web', 'check.admin.session')->prefix('admin')->group(function () {
    //管理员
    Route::get('user', 'Backend\AdminController@user')->middleware('active.menu');
    Route::get('get_admins_ajax', 'Backend\AdminController@getAdminsAjax');
    Route::post('create_or_update_admin_ajax', 'Backend\AdminController@createOrUpdateAdminAjax');
    Route::post('delete_admin_ajax', 'Backend\AdminController@deleteAdminAjax');
});

