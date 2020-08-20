@extends('Backend.layouts')
@section('setting_main_menu')
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
            prop="mm_name"
            label="主菜单名">
        </el-table-column>
        <el-table-column
            prop="mm_icon"
            label="主菜单图标">
        </el-table-column>
        <el-table-column
            prop="mm_desc"
            label="主菜单描述">
        </el-table-column>
        <el-table-column
            prop="order"
            label="排序">
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
            <el-form-item label="主菜单名">
                <el-input v-model="rowData.mm_name" ref="mm_name_input"></el-input>
            </el-form-item>
            <el-form-item label="主菜单描述">
                <el-input v-model="rowData.mm_desc" ref="mm_desc_input"></el-input>
            </el-form-item>
            <el-form-item label="主菜单图标">
                <el-input v-model="rowData.mm_icon" ref="mm_icon_input"></el-input>
            </el-form-item>
            <el-form-item label="排序">
                <el-input v-model="rowData.order" ref="order_input"></el-input>
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
            retrieveUrl: '/setting/get_main_menus_ajax',
            saveUrl: '/setting/create_or_update_main_menu_ajax',
            delUrl: '/setting/delete_main_menu_ajax', 

            //单行数据
            rowData: {},

            dialogTitle: '',
            dialogVisible: false,
        },
        mounted(){
            this.getTableData(this.retrieveUrl, this.filterData);
        },
        methods: {
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