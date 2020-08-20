//获取表格数据
Vue.prototype.getTableData = function (url, data){
    const loading = this.$loading({
        lock: true,
        text: 'Loading',
        spinner: 'el-icon-loading',
        background: 'rgba(0, 0, 0, 0.7)'
    });
	that = this;
	axios.get(url, {
      params: data
  }).then(function (response) {
      that.tableData = response.data;
      loading.close();
  }).catch(function (error) {
      that.$notify.error(error);
  });
};

//新增按钮点击
Vue.prototype.createBtnClick = function(){
    that = this;
    that.dialogVisible = true;
    that.dialogTitle = '新增';
    that.rowData = {};
};

//编辑按钮点击
Vue.prototype.editBtnClick = function(data){
    that = this;
    that.dialogVisible = true;
    that.dialogTitle = '编辑';
    that.rowData = data;
};

//详情按钮点击
Vue.prototype.viewBtnClick = function(data){
    that = this;
    that.dialogVisible = true;
    that.dialogTitle = '详情';
    that.rowData = data;
    axios.get('/oplog/get_logform_ajax', {
        params: data
    }).then(function (response) {
        that.logform = response.data;
    }).catch(function (error) {
        that.$notify({
          message: error,
          type: "error",
          position: 'bottom-right'
        });
    });
};

//删除按钮点击
Vue.prototype.deleteBtnClick = function(delUrl, retrieveUrl, rowData, filterData){
    this.$confirm('确定删除?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
    }).then(() => {
        that = this;
        axios.post(delUrl, {
            id: rowData.id
        }).then(function (response) {
            if(response.data[0] === true){
                that.$notify({
                  message: response.data[1],
                  type: "success",
                  position: 'bottom-right'
                });
                that.getTableData(retrieveUrl, filterData);
            }else{
                that.$notify({
                  message: response.data[1],
                  type: "warning",
                  position: 'bottom-right'
                });
            } 
        })
        .catch(function (error) { // 请求失败处理
            that.$notify({
              message: error,
              type: "error",
              position: 'bottom-right'
            });
        });
    }).catch(() => {
        this.$notify({
            type: 'info',
            message: '已取消',
            position: 'bottom-right'
        });          
    });
};

//创建或更新记录
Vue.prototype.saveRowData = function (saveUrl, retrieveUrl, rowData, filterData){
	axios.post(saveUrl, rowData).then(function (response) {
        if(response.data[0] === true){
            that.$notify({
              message: response.data[1],
              type: "success",
              position: 'bottom-right'
            });
            that.dialogVisible = false;
            that.getTableData(retrieveUrl, filterData);
        }else{
            that.$notify({
              message: response.data[1],
              type: "warning",
              position: 'bottom-right'
            });
        } 
    }).catch(function (error) { // 请求失败处理
        that.$notify({
              message: error,
              type: "error",
              position: 'bottom-right'
            });
    });
};

//封禁
Vue.prototype.banBtnClick = function(banUrl, retrieveUrl, rowData, filterData){
    this.$confirm('确定封禁此用户?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
    }).then(() => {
        that = this;
        axios.post(banUrl, {
            id: rowData.id
        }).then(function (response) {
            if(response.data[0] === true){
                that.$notify({
                  message: response.data[1],
                  type: "success",
                  position: 'bottom-right'
                });

                that.getTableData(retrieveUrl, filterData);
            }else{
                that.$notify({
                  message: response.data[1],
                  type: "warning",
                  position: 'bottom-right'
                });
            } 
        })
        .catch(function (error) { // 请求失败处理
            that.$notify({
              message: error,
              type: "error",
              position: 'bottom-right'
            });
        });
    }).catch(() => {
        this.$notify({
            type: 'info',
            message: '已取消',
            position: 'bottom-right'
        });          
    });
};

//解封
Vue.prototype.unbanBtnClick = function(unbanUrl, retrieveUrl, rowData, filterData){
	this.$confirm('确定解封此用户?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
    }).then(() => {
        that = this;
        axios.post(unbanUrl, {
            id: rowData.id
        }).then(function (response) {
            if(response.data[0] === true){
                that.$notify({
                  message: response.data[1],
                  type: "success",
                  position: 'bottom-right'
                });

                that.getTableData(retrieveUrl, filterData);
            }else{
                that.$notify({
                  message: response.data[1],
                  type: "warning",
                  position: 'bottom-right'
                });
            } 
        })
        .catch(function (error) { // 请求失败处理
            that.$notify({
              message: error,
              type: "error",
              position: 'bottom-right'
            });
        });
    }).catch(() => {
        this.$notify({
            type: 'info',
            message: '已取消',
            position: 'bottom-right'
        });          
    });
};

