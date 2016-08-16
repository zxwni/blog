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
$app->get('admin/login','Admin/AdminLoginController@login');

//$app->get('/test','App\Http\Controllers\TestController@test');
$app->group(['namespace'=>'App\Http\Controllers'],function ($app){
    $app->get('test/test','TestController@test');
    $app->get('test/select','TestController@select');
    $app->get('admin/login','Admin\AdminController@login');
    $app->get('admin/code','Admin\AdminController@code');
    $app->post('admin/checklogin','Admin\AdminController@checklogin');



});
