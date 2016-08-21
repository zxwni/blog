@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加链接
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加链接</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加链接</a>
            <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部分类</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->


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

    <form action="{{url('admin/links/storecreate')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>链接名称：</th>
                <td>
                    <input type="text" name="link_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>链接地址：</th>
                <td>
                    <input type="text" class="lg"  name="link_url" value="http://">
                    <span><i class="fa fa-exclamation-circle yellow"></i>链接地址必须填写</span>
                </td>
            </tr>
            <tr>
                <th>链接标题：</th>
                <td>
                    <input type="text" class="lg"  name="link_title">
                </td>
            </tr>

            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="link_order" value="0">
                    <span><i class="fa fa-exclamation-circle yellow"></i>默认排序为0</span>
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






@endsection