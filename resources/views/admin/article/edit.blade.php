@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加文章
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加文章</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>添加文章</a>
            <a href="#"><i class="fa fa-recycle"></i>全部文章</a>
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

    <form action="{{url('admin/article/storecreate')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">分类：</th>
                <?php
                  $data=json_decode($data);
                ?>
                <td>
                    <select name="cate_id">
                        @foreach($data as $d)
                            <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>文章标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title">
                </td>
            </tr>

            <tr>
                <th>编辑：</th>
                <td>
                    <input type="text" class="sm" name="art_editor">
                </td>
            </tr>

            <tr>
                <th>图片上传：</th>
                <td>
                    <input type="file" size="50" name="art_thumb">

                </td>
            </tr>
            <tr>
                <th>关键词：</th>
                <td>
                    <input type="text" class="lg" name="art_tag">
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="art_description"></textarea>
                </td>
            </tr>
            <tr>
                <th>文章内容：</th>
                <td >
                    <script type="text/javascript" charset="utf-8" src="/resources/views/org/uedit/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/resources/views/org/uedit/ueditor.all.min.js"> </script>
                    <script type="text/javascript" charset="utf-8" src="/resources/views/org/uedit/lang/zh-cn/zh-cn.js"></script>
                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:300px;"></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height:28px ;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden;height: 20px}
                        div.edui-box{overflow: hidden;height: 22px;}
                    </style>
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