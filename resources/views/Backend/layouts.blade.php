@extends('layouts')
@section('backend_layouts')
    <el-container style="height: 850px;">
        <el-header style="background-color: #303133;line-height: 2.5em;height: 3em; z-index: 32;color: #FFFFFF">
            <el-row type="flex" class="row-bg" justify="space-between">
                <el-col :span="6">
                    <el-link :underline="false" href="/" style="font-size: 18px;;color: #FFFFFF"><span>{{env('APP_NAME')}}</span></el-link>
                    
                </el-col>
                @if(session('admin'))
                <el-col :span="6" style="text-align: right;">
                    <el-dropdown>
                        <i class="el-icon-user-solid" style="color: #FFFFFF"></i>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item><el-link :underline="false" href="/home/modify_passwd">修改密码</el-link></el-dropdown-item>
                            <el-dropdown-item><el-link :underline="false" href="/home/sign_out">退出</el-link></el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                    <span style="font-size: 16px;">{{ session('admin')['name'] }}</span>
                </el-col>
                @endif
            </el-row>
        </el-header>
        <el-container>
            @if(session('admin'))
            <el-aside width="220px">
                <el-menu
                :default-active="activeMenu"
                active-text-color="#409EFF">
                    @foreach(session('admin')['menus'] as $mmk => $mainMenu)
                        @if(!empty($mainMenu['sub_menu']))
                            <el-submenu index="{{ $mainMenu['id'] }}">
                                <template slot="title">
                                  <i class="el-icon-{{ $mainMenu['mm_icon'] }}"></i>
                                  <span style="font-size: 16px; font-weight:bold;">{{ $mainMenu['mm_desc'] }}</span>
                                </template>
                                @foreach($mainMenu['sub_menu'] as $smk => $subMenu)
                                    <el-link :underline="false" href="/{{ $mainMenu['mm_name'] }}/{{ $subMenu['sm_name'] }}" style="margin-left: 15px">
                                        <el-menu-item index="{{ $mainMenu['id'] }}-{{ $subMenu['id'] }}">{{ $subMenu['sm_desc'] }}
                                        </el-menu-item>
                                    </el-link>
                                @endforeach
                            </el-submenu>
                            @endif
                    @endforeach
                </el-menu>
            </el-aside>
            @endif
            <el-main style="background-color: #F2F6FC">
                @yield('home_signin')
                @yield('home_dashboard')
                @yield('recharge_order')
                @yield('recharge_manual_recharge')
                @yield('recharge_auto')
                @yield('recharge_channel')
                @yield('setting_role')
                @yield('setting_sub_menu')
                @yield('setting_main_menu')
                @yield('member_user')
                @yield('member_level')
                @yield('data_member_statistics')
                @yield('data_recharge_statistics')
                @yield('agent_user')
                @yield('admin_user')
                @yield('oplog_index')
                @yield('oplog_logform_recharge_order')
                @yield('oplog_logform_member')
                
            </el-main>
        </el-container>
    </el-container>
@endsection