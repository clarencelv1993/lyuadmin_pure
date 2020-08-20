<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- import CSS -->
    <link rel="stylesheet" href="/static/css/index.css">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        .el-table th.gutter{
            display: table-cell!important;
        }
        .el-transfer-panel {
            border: 1px solid #EBEEF5;
            border-radius: 4px;
            overflow: hidden;
            background: #FFF;
            display: inline-block;
            vertical-align: middle;
            width: 250px;
            max-height: 100%;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            position: relative;
        }
    </style>
</head>
<body style="margin: 0px">
    <div id="app">
        @yield('backend_layouts')
        @yield('frontend_layouts')
    </div>
</body>
<!-- import Vue before Element -->
<script src="/static/js/vue.js"></script>
<!-- import JavaScript -->
<script src="/static/js/index.js"></script>
<script src="/static/js/axios.min.js"></script>
<script src="/static/js/main.js?{{ date('YmdHis') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@4.8.0/dist/echarts.min.js"></script>
@yield('js')
</html>