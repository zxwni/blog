<?php namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //展示列表
    public function index()
    {
        $data=Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.index',compact('data'));
    }

    //排序
    public function changeorder(Request $request)
    {
        $res=$request->all();
        $nav_id=$res['nav_id'];
        $nav_order=$res['nav_order'];
        $li=Navs::find($nav_id);
        $li->nav_order=$nav_order;
        $re=$li->update();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'分类排序更新成功',
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'分类排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }

    //添加导航页面
    public function create()
    {
        return view('admin.navs.add');
    }

    //添加导航处理
    public function store(Request $request)
    {
        $input=$request->except('_token');
        if(!$input){
            return view('admin.navs.add');
        }else{
            $rules=[
                'nav_name'=>'required',
                'nav_url'=>'required',
            ];
            $message=[
                'nav_name.required'=>'导航名称不能为空',
                'nav_url.required'=>'导航链接地址不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re= Navs::create($input);
                if($re){
                    return redirect('admin/navs');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }


    //更新导航页面
    public function edit($nav_id)
    {
        $field=Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }
    //更新导航处理
    public function update(Request $request,$nav_id)
    {
        $input=$request->except('_token','_method');
        if(!$input){
            return view('admin.navs.edit');
        }else{
            $rules=[
                'nav_name'=>'required',
                'nav_url'=>'required',
            ];
            $message=[
                'nav_name.required'=>'链接名称不能为空',
                'nav_url.required'=>'链接地址不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re=Navs::where('nav_id',$nav_id)->update($input);
                if($re){
                    return redirect('admin/navs');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }

    //删除导航
    public function delete($nav_id)
    {
        $re=Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'分类删除成功',
            ];

        }else{
            $data=[
                'status'=>1,
                'msg'=>'分类删除失败，请稍后重试',
            ];
        }
        return $data;
    }




}
