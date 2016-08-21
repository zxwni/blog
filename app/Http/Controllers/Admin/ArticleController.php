<?php namespace App\Http\Controllers\Admin;



use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //展示全部文章列表
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(5);
        return view('admin.article.index',compact('data'));
    }

    //添加文章 页面
    public function create()
    {
        $data=(new Category)->tree();
        return view('admin.article.add',compact('data'));
    }
    //添加文章 处理
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $input['art_time']=time();
        $rules=[
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $message=[
            'art_title.required'=>'文章标题不能为空',
            'art_content.required'=>'文章内容不能为空',
        ];
        $validator=Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re= Article::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return redirect()->back()->with('msg','数据添加失败，请稍后重试');
            }
        }else{
            return redirect()->back()->withErrors($validator->errors());
        }
    }

    //更新文章页面
    public function edit($art_id)
    {
        $data=(new Category)->tree();
        $field=Article::find($art_id);
        return view('admin.article.edit',compact('data','field'));
    }


    //更新分类处理
    public function update(Request $request,$art_id)
    {
        $input=$request->except('_token','_method');
        $re=Article::where('art_id',$art_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return redirect()->back()->with('msg','更新失败，请稍后重试');
        }
    }

    //删除文章
    public function delete($art_id)
    {
        $re=Article::where('art_id',$art_id)->delete();
        if($re){
            $data=[
              'status'=>0,
                'msg'=>'文章删除成功',
            ];

        }else{
            $data=[
              'status'=>1,
                'msg'=>'文章删除失败，请稍后重试',
            ];
        }
        return $data;
    }




}
