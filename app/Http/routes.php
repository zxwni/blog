<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
        return $app->welcome();
    });
//
//    $app->get('/test', function() use ($app) {
//        return "hello world";
//    });
//    $app->get('user/{id}', function ($id) {
//        return 'User '.$id;
//    });
//    $app->get('posts/{post}/comments/{comment}',function($postId,$comment){
//    return
//});

//前台
$app->group(['namespace'=>'App\Http\Controllers\Home'],function($app){
    $app->get('/','IndexController@index');
    $app->get('/cate/{cate_id}','IndexController@cate');
    $app->get('/a/{art_id}','IndexController@article');
});



//后台登陆
$app->group(['namespace'=>'App\Http\Controllers\Admin'],function ($app){

    $app->get('admin/login','AdminController@login');
    $app->get('admin/code','AdminController@code');
    $app->post('admin/checklogin','AdminController@checklogin');

});
//后台管理
$app->group(['middleware'=>'adminlogin','prefix'=>'admin','namespace'=>'App\Http\Controllers\Admin'],function ($app){
   //后台首页
    $app->get('index','IndexController@index');
    //后台信息展示
    $app->get('info','IndexController@info');
    //退出
    $app->get('quit','AdminController@quit');
    //更改密码
    $app->get('pass','IndexController@pass');
    $app->post('pass','IndexController@pass');

    //分类管理
        //分类首页
        $app->get('category','CategoryController@index');
        //排序更改
        $app->post('cate/changeorder','CategoryController@changeorder');
        //添加分类页面显示
        $app->get('category/create','CategoryController@create');
        //添加分类提交的处理
        $app->post('storecreate','CategoryController@store');
        //更新分类页面显示
        $app->get('category/{category}/edit','CategoryController@edit');
        //更新分类处理
        $app->put('category/{category}/update','CategoryController@update');
        //删除分类
        $app->delete('category/{category}','CategoryController@delete');


    //文章管理
        //文章首页
        $app->get('article','ArticleController@index');
        //添加文章页面显示
        $app->get('article/create','ArticleController@create');
        //添加文章提交的处理
        $app->post('article/storecreate','ArticleController@store');
        //更新文章页面显示
        $app->get('article/{article}/edit','ArticleController@edit');
        //更新文章处理
        $app->put('article/{article}/update','ArticleController@update');
        //删除文章
        $app->delete('article/{article}','ArticleController@delete');

    //l友情链接
        //链接首页
        $app->get('links','LinksController@index');
        //排序更改
        $app->post('links/changeorder','LinksController@changeorder');
        //添加分类页面显示
        $app->get('links/create','LinksController@create');
        //添加分类提交的处理
        $app->post('links/storecreate','LinksController@store');
        //更新链接页面显示
        $app->get('links/{links}/edit','LinksController@edit');
        //更新链接处理
        $app->put('links/{links}/update','LinksController@update');
        //删除链接
        $app->delete('links/{links}','LinksController@delete');


    //导航
        //导航首页
        $app->get('navs','NavsController@index');
        //排序更改
        $app->post('navs/changeorder','NavsController@changeorder');
        //添加导航页面显示
        $app->get('navs/create','NavsController@create');
        //添加导航提交的处理
        $app->post('navs/storecreate','NavsController@store');
        //更新导航页面显示
        $app->get('navs/{navs}/edit','NavsController@edit');
        //更新导航处理
        $app->put('navs/{navs}/update','NavsController@update');
        //删除链接
        $app->delete('navs/{navs}','NavsController@delete');

    //配置
        //配置首页
        $app->get('config','ConfigController@index');
        //排序更改
        $app->post('config/changeorder','ConfigController@changeorder');
        //添加配置页面显示
        $app->get('config/create','ConfigController@create');
        //添加配置提交的处理
        $app->post('config/storecreate','ConfigController@store');
        //更新配置项页面显示
        $app->get('config/{config}/edit','ConfigController@edit');
        //更新配置项处理
        $app->put('config/{config}/update','ConfigController@update');
        //删除配置项
        $app->delete('config/{config}','ConfigController@delete');
        //配置内容提交
        $app->post('config/changecontent','ConfigController@changecontent');
        //导出配置内容提交
        $app->get('config/putfile','ConfigController@putFile');

    //图片上传路由
        $app->post('upload','CommonController@uploadfile');
});
