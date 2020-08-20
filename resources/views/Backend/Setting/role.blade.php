@extends('Backend.layouts')
@section('setting_role')
    <el-button type="success" @click="createBtnClick({})">新增</el-button>
    <br>
    <br>
    <el-table
        :data="tableData"
        border
        stripe
        size="small">
        <el-table-column
            label="#"
            type="index">
        </el-table-column>
        <el-table-column
            prop="role_name"
            label="角色名">
        </el-table-column>
        <el-table-column
            prop="role_desc"
            label="角色描述">
        </el-table-column>
        <el-table-column
            prop="role_permission"
            label="角色权限">
            <template slot-scope="scope">
                <el-popover
                    placement="top-start"
                    trigger="click">
                    <el-tag type="success" v-for="rolePermission in rolePermissionData" size="small" style="margin-right: 10px">@{{ rolePermission.sm_desc }}</el-tag>
                  <el-button slot="reference" size="mini" @click="getRolePerssion(scope.row.role_permission)">点击查看</el-button>
                </el-popover>
            </template>
        </el-table-column>
        <el-table-column
            prop="is_enabled"
            label="启用状态">
            <template slot-scope="scope">
                <el-switch
                  v-model="scope.row.is_enabled"
                  active-text="已启用"
                  inactive-text="未启用"
                  active-color="#13ce66"
                  inactive-color="#ff4949"
                  disabled>
                </el-switch>
            </template>
        </el-table-column>
        <el-table-column
            prop="created_by"
            label="创建者">
        </el-table-column>
        <el-table-column
            prop="created_at"
            label="创建时间">
        </el-table-column>
        <el-table-column
            prop="updated_by"
            label="更新者">
        </el-table-column>
        <el-table-column
            prop="updated_at"
            label="更新时间">
        </el-table-column>
        <el-table-column
            prop="name"
            label="操作"
            width="180">
            <template slot-scope="scope">
                <el-button type="primary" size="mini" @click="editBtnClick(scope.row)">编辑</el-button>
                <el-button type="danger" size="mini" @click="deleteBtnClick(delUrl, retrieveUrl, scope.row, filterData)">删除</el-button>
            </template>
        </el-table-column>
    </el-table>

    <!-- <el-row type="flex" class="row-bg" justify="end">
        <el-pagination
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          :page-sizes="[10, 20, 40, 80]"
          layout="total, sizes, prev, pager, next, jumper"
          :total="tableData.total"
          background>
        </el-pagination>
    </el-row> -->

    <el-dialog
        :title="dialogTitle" 
        :visible.sync="dialogVisible"
        width="60%">
        <el-form ref="dialogForm" :model="rowData" label-width="100px" label-position="left">
            <el-form-item label="角色名">
                <el-input v-model="rowData.role_name" ref="role_name_input"></el-input>
            </el-form-item>
            <el-form-item label="角色描述">
                <el-input v-model="rowData.role_desc" ref="role_desc_input"></el-input>
            </el-form-item>
            <el-form-item label="角色权限">
                <el-transfer
                    filterable
                    filter-placeholder="请输入菜单名"
                    v-model="rowData.role_permission"
                    :data="transferData"
                    :titles="['未授权', '已授权']">
                </el-transfer>
            </el-form-item>
            <el-form-item label="是否启用">
                <el-switch
                  v-model="rowData.is_enabled"
                  active-text="启用"
                  inactive-text="禁用"
                  active-color="#13ce66"
                  inactive-color="#ff4949">
                </el-switch>
            </el-form-item>
            <el-form-item label="创建时间">
                <el-input v-model="rowData.created_at" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="创建者">
                <el-input v-model="rowData.created_by" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="更新时间">
                <el-input v-model="rowData.updated_at" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="更新者">
                <el-input v-model="rowData.updated_by" :disabled="true"></el-input>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogVisible = false">取 消</el-button>
          <el-button type="primary" @click="saveRowData(saveUrl, retrieveUrl, rowData, filterData)">保存</el-button>
        </div>
    </el-dialog>


@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            //活跃菜单
            activeMenu: "{{session('activeMenu')}}",

            //筛选表单
            filterData: {
                page: "1",
                size: "10"
            },

            //表格数据
            tableData: [],

            //curd url
            retrieveUrl: '/setting/get_roles_ajax',
            saveUrl: '/setting/create_or_update_role_ajax',
            delUrl: '/setting/delete_role_ajax', 

            //单行数据
            rowData: {},

            //穿梭框数据
            transferData: [],

            //角色权限数据
            rolePermissionData: [],

            dialogTitle: '',
            dialogVisible: false,


        },
        mounted(){
            this.getTableData(this.retrieveUrl, this.filterData);
            this.getAllSubMenus();
        },
        methods:{
            getAllSubMenus(){
                that = this;
                axios.get('/setting/get_sub_menus_array_ajax')
                    .then(function (response) {
                        console.log(response)
                        response.data.forEach((subMenu, index) => {
                            that.transferData.push({
                                label: subMenu.main_menu.mm_desc+"-"+subMenu.sm_desc,
                                key: subMenu.id
                            });
                        });
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    });
            },
            getRolePerssion(role_permission){
                that = this;
                axios.post('/setting/get_role_permission_ajax', {subMenus: role_permission})
                    .then(function (response) {
                        that.rolePermissionData = response.data;
                        console.log(that.rolePermissionData)
                    })
                    .catch(function (error) { // 请求失败处理
                        console.log(error);
                    }); 
            },
        }

    })
</script>
@endsection