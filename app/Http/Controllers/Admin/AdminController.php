<?php namespace App\Http\Controllers\Admin;


class AdminController extends CommonController
{
    public function login(){
        return view('admin.login');
    }
}
