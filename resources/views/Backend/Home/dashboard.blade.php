@extends('Backend.layouts')
@section('home_dashboard')
    后台管理系统首页
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data: function() {
            return {
                activeMenu: "{{ session('activeMenu') }}"
            }
        },
        mounted(){
        },
        methods: {
        }
    })
</script>
@endsection