<?php namespace App\Http\Controllers\Admin;

use Symfony\Component\Console\Input\Input;

require_once '../resources/views/org/Code.class.php';
class AdminController extends CommonController
{
    public function login()
    {
            return view('admin.login');
    }
    public function Code()
    {
       $code=new \Captcha();
        $code->create();

    }

}
