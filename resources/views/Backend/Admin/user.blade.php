@extends('Backend.layouts')
@section('admin_user')
    <el-button type="success" @click="createBtnClick({})">新增</el-button>
    <br>
    <br>
    <el-table
        :data="tableData.data"
        border
        stripe
        size="small">
        <el-table-column
            label="#"
            type="index">
        </el-table-column>
        <el-table-column
            prop="admin_name"
            label="用户名">
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

    <el-row type="flex" class="row-bg" justify="end">
        <el-pagination
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          :page-sizes="[10, 20, 40, 80]"
          layout="total, sizes, prev, pager, next, jumper"
          :total="tableData.total"
          background>
        </el-pagination>
    </el-row>

    <el-dialog
        :title="dialogTitle" 
        :visible.sync="dialogVisible"
        width="50%">
        <el-form ref="dialogForm" :model="rowData" label-width="100px" label-position="left">
            <el-form-item label="用户名">
                <el-input v-model="rowData.admin_name" ref="admin_name_input"></el-input>
            </el-form-item>
            <el-form-item label="用户密码">
                <el-input v-model="rowData.admin_passwd" ref="admin_passwd_input" type="password"></el-input>
            </el-form-item>
            <el-form-item label="确认密码">
                <el-input v-model="rowData.admin_passwd_confirm" ref="admin_passwd_input" type="password"></el-input>
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
            //单行数据
            //单行数据
            rowData: {},
            //curd url
            retrieveUrl: '/admin/get_admins_ajax',
            saveUrl: '/admin/create_or_update_admin_ajax',
            delUrl: '/admin/delete_admin_ajax', 

            banUrl: '/admin/ban_ajax',
            unbanUrl: '/admin/unban_ajax',

            dialogTitle: '',
            dialogVisible: false,


        },
        mounted(){
            this.getTableData(this.retrieveUrl, this.filterData);
        },
        methods:{
            handleSizeChange(size){
                this.filterData.size = size;
                this.getTableData(this.retrieveUrl, this.filterData);
            },
            handleCurrentChange(page){
                this.filterData.page = page;
                this.getTableData(this.retrieveUrl, this.filterData);
            }
        }

    })
</script>
@endsection