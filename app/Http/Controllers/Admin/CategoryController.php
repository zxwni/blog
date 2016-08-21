<?php namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index(){
        return view('admin.index');
    }
    public function info(){
        return view('admin.info');
    }
    //修改密码
    public function pass(Request $request){
        $input=$request->all();
        if(!$input){
            return view('admin.pass');
        }else{
            $rules=[
                'password'=>'required|between:6,20|confirmed',
            ];
            $message=[
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',

            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user=$request->session()->get('user');
                $user=json_decode($user);
                $u=User::find($user->uid);
                if($u->upassword==$input['password_o']){
                    $u->upassword = $input['password'];
                    $u->update();
                    return redirect()->back()->with('msg','密码修改成功');
                }else{
                    return redirect()->back()->with('msg','原密码输入错误');
            }
            }else{
//                dd($validator->errors()->all());
                return redirect()->back()->withErrors($validator->errors());
            }

        }


    }



}
