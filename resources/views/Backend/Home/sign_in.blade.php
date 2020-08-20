@extends('Backend.layouts')
@section('home_signin')
<el-row type="flex" class="row-bg" justify="center">
  <el-col :span="8">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <h2>登录</h2>
      </div>
      <el-form ref="form" :model="signinForm" label-width="80px">
      <el-form-item label="用户名">
          <el-input v-model="signinForm.admin_name"></el-input>
      </el-form-item>
      <el-form-item label="密码">
          <el-input v-model="signinForm.admin_passwd" type="password"></el-input>
        <el-link type="warning">忘记密码？</el-link>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm">登录</el-button>
      </el-form-item>
    </el-form>
  </el-card>
  </el-col>
</el-row>

	
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data: function() {
            return {
                signinForm: {
                	admin_name: "",
                	admin_passwd: ""
                }
            }
        },
        methods: {
        	submitForm(){
                that = this;
                axios.post('/home/sign_in_ajax', that.signinForm)
                .then(function (response) {
                    console.log(response);
                    if(response.data[0] === true){
                        that.$notify({
                          message: response.data[1],
                          type: "success",
                          position: 'bottom-right'
                        });
                        location.href="/home";
                    }else{
                        that.$notify({
                          message: response.data[1],
                          type: "warning",
                          position: 'bottom-right'
                        });
                    } 
                })
                .catch(function (error) {
                    that.$notify({
                      message: error,
                      type: "error",
                      position: 'bottom-right'
                    });
                });
        	}
        }
    })
</script>
@endsection