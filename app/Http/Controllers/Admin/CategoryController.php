<?php namespace App\Http\Controllers\Admin;





use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //展示分类
    public function index()
    {
        $data=(new Category)->tree();
        return view('admin.category.index',compact('data'));
    }
    //排序
    public function changeorder(Request $request)
    {
        $res=$request->all();
        $cate_id=$res['cate_id'];
        $cate_order=$res['cate_order'];
        $cate=Category::find($cate_id);
        $cate->cate_order=$cate_order;
        $re=$cate->update();
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

    //添加分类页面
    public function create()
    {
        $data=Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }
    //添加分类处理
    public function store(Request $request)
    {
        $input=$request->except('_token');
        if(!$input){
            return view('admin.category.add');
        }else{
            $rules=[
                'cate_name'=>'required',
            ];
            $message=[
                'cate_name.required'=>'分类名称不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
               $re= Category::create($input);
                if($re){
                    return redirect('admin/category');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }
    //更新分类页面
    public function edit($cate_id)
    {
        $field=Category::find($cate_id);
        $data=Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('data','field'));
    }
    //更新分类处理
    public function update(Request $request,$cate_id)
    {
       $input=$request->except('_token','_method');
       $re=Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return redirect()->back()->with('msg','更新失败，请稍后重试');
        }
    }

    //删除分类
    public function delete($cate_id)
    {
        $re=Category::where('cate_id',$cate_id)->delete();
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
