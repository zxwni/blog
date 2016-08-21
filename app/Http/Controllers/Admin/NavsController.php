<?php namespace App\Http\Controllers\Admin;





use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //展示列表
    public function index()
    {
       $data=Links::orderBy('link_order','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    //排序
    public function changeorder(Request $request)
    {
        $res=$request->all();
        $link_id=$res['link_id'];
        $link_order=$res['link_order'];
        $li=Links::find($link_id);
        $li->link_order=$link_order;
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

    //添加链接页面
    public function create()
    {
        return view('admin.links.add');
    }
    //添加链接处理
    public function store(Request $request)
    {
        $input=$request->except('_token');
        if(!$input){
            return view('admin.links.add');
        }else{
            $rules=[
                'link_name'=>'required',
                'link_url'=>'required',
            ];
            $message=[
                'link_name.required'=>'链接名称不能为空',
                'link_url.required'=>'链接地址不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re= Links::create($input);
                if($re){
                    return redirect('admin/links');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }

    //更新链接页面
    public function edit($link_id)
    {
        $field=Links::find($link_id);
        return view('admin.links.edit',compact('field'));
    }
    //更新链接处理
    public function update(Request $request,$link_id)
    {
        $input=$request->except('_token','_method');
        if(!$input){
            return view('admin.links.edit');
        }else{
            $rules=[
                'link_name'=>'required',
                'link_url'=>'required',
            ];
            $message=[
                'link_name.required'=>'链接名称不能为空',
                'link_url.required'=>'链接地址不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re=Links::where('link_id',$link_id)->update($input);
                if($re){
                    return redirect('admin/links');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }


    //删除链接
    public function delete($link_id)
    {
        $re=Links::where('link_id',$link_id)->delete();
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
