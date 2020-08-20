@extends('Backend.layouts')
@section('setting_sub_menu')
    <el-button type="success" @click="createBtnClick({})">新增</el-button>
    <br>
    <br>
    <el-table
        :data="tableData.data"
        border
        stripe
        size="small"
        style="width: 100%">
        <el-table-column
            label="#"
            type="index">
        </el-table-column>
        <el-table-column
            prop="sm_name"
            label="子菜单名">
        </el-table-column>
        <el-table-column
            prop="sm_desc"
            label="子菜单描述">
        </el-table-column>
        <el-table-column
            prop="main_menu.mm_desc"
            label="主菜单">
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
            <el-form-item label="子菜单名">
                <el-input v-model="rowData.sm_name" ref="sm_name_input"></el-input>
            </el-form-item>
            <el-form-item label="子菜单描述">
                <el-input v-model="rowData.sm_desc" ref="sm_desc_inut"></el-input>
            </el-form-item>
            <el-form-item label="从属主菜单">
                <el-select v-model="rowData.mm_id" placeholder="请选择" ref="sm_desc_select">
                    <el-option
                        v-for="mainMenu in mainMenus"
                        :key="mainMenu.id"
                        :label="mainMenu.mm_desc"
                        :value="mainMenu.id">
                    </el-option>
                </el-select>
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
            retrieveUrl: '/setting/get_sub_menus_ajax',
            saveUrl: '/setting/create_or_update_sub_menu_ajax',
            delUrl: '/setting/delete_sub_menu_ajax', 

            //单行数据
            rowData: {},

            dialogTitle: '',
            dialogVisible: false,

            mainMenus: [],
        },
        mounted(){
            this.getTableData(this.retrieveUrl, this.filterData);
            this.getAllMainMenus();
        },
        methods: {
            getAllMainMenus(){
                that = this;
                axios.get('/setting/get_main_menus_array_ajax')
                    .then(function (response) {
                        that.mainMenus = response.data;
                        console.log(that.mainMenus);
                    })
                    .catch(function (error) {
                        that.$message.error(error);
                    });
            },
            handleSizeChange(size){
                this.filterData.size = size;
                this.getTableData(this.retrieveUrl, this.filterData);
            },
            handleCurrentChange(page){
                this.filterData.page = page;
                this.getTableData(this.retrieveUrl, this.filterData);
            },
        }
    })
</script>
@endsection