@extends('layouts.admin')
@section('content')
        <!--面包屑配置项 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项管理
</div>
<!--面包屑配置项 结束-->

<!--结果集标题与配置项组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加配置项</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置项</a>
        </div>
    </div>
</div>
<!--结果集标题与配置项组件 结束-->


<div class="result_wrap">

    <div class="mark" style="margin-left: 10px">
        @if(session('msg'))
            <p style="color: red"><?php  echo session('msg')?></p>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif
    </div>

    <form action="{{url('admin/config/storecreate')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" name="conf_title">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" name="conf_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>类型：</th>
                <td>
                    <input type="radio" name="field_type" value="input" checked onclick="showTr()">input&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="field_type" value="textarea" onclick="showTr()">textarea&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="field_type" value="radio" onclick="showTr()">radio&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr class="field_value">
                <th>类型值：</th>
                <td>
                    <input type="text" class="lg" name="field_value" >
                    <p>
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式:1|开启,0|关闭</span>
                    </p>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="conf_order" value="0">
                    <span><i class="fa fa-exclamation-circle yellow"></i>默认排序为0</span>
                </td>
            </tr>
            <tr>
                <th>说明：</th>
                <td>
                   <textarea name="conf_tips" id="" cols="30" rows="10" ></textarea>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<script>
    showTr();
    function showTr(){
        var type=$('input[name=field_type]:checked').val();
        if(type == 'radio'){
            $('.field_value').show();
        }else{
            $('.field_value').hide();
        }

    }


</script>




@endsection