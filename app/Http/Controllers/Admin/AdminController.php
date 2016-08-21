<?php namespace App\Http\Controllers\Admin;



use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

require_once '/resources/views/org/Code.class.php';
class AdminController extends CommonController
{
    public function login()
    {
//        dd($_SERVER);

        return view('admin.login');
    }

    public function quit(Request $request)
    {
        $request->session()->forget('user');
        return redirect('admin/login');
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
                $getname=$get['user_name'];
                $attributes=[
                    'uname'=>"$getname",
                ];
                $user = User::firstByAttributes($attributes);
                $flag = false;
                if(is_object($user)) {
                    if($user->upassword == $get['user_pass']){
                        $flag=true;
                    }
                }
                if (!$flag) {
                    return redirect()->back()->with('msg', '用户名或者密码错误');
                } else {
                    $request->session()->put('user',"$user");
                    return  redirect('admin/index');
                }
            }
        }
    }

}
