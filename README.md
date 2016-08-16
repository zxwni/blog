# blog
lumen's blog project

routes.php 
<?php
  $app->group(['namespace'=>'App\Http\Controllers'],function ($app){
    $app->get('test/test','TestController@test');
    $app->get('test/select','TestController@select');
    $app->get('admin/login','Admin\AdminController@login');
  });
  
  
