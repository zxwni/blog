<?php namespace App\Http\Controllers\Admin;



use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function checklogin(Request $request)
    {
        $get = $request->all();
        $code = new \Captcha();
        $getcode = $code->getCode();
        $validator = Validator::make($request->all(), [
            'code' => "required",
            'user_name' => 'required',
            'user_pass' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            if(strtolower($get['code'])!=strtolower($getcode)){
                return redirect()->back()->with('msg','验证码错误');
            }else{
                $user = User::all();
                $flag = false;
                foreach ($user as $k => $v) {
                    if ($v->uname == $get['user_name'] && $v->upassword == $get['user_pass']) {
                        $flag = true;
                    }
                }
                if (!$flag) {
                    return redirect()->back()->with('msg', '用户名或者密码错误');
                } else {
                    echo 'ok';
                    session(['user'=>$user]);
                    dd(session('user'));
                }
            }
        }
    }

}
