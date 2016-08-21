<?php namespace App\Http\Controllers\Home;





use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Config;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    public function index()
    {
        //点击量最高6篇的文章
        $hot=Article::orderBy('art_view','desc')->take(6)->get();

        //分页效果的图文列表5篇
        $data=Article::orderBy('art_time','desc')->paginate(5);
        //友情连接
        $links=Links::orderBy('link_order','asc')->get();
        //配置项
        $conf=Config::all();

//        dd($conf);
        return view('home.index',compact('hot','new','data','links','hot2'));
    }

    public function cate($cate_id)
    {
        $field=Category::find($cate_id);
        //分页效果的图文列表4篇
        $data=Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
//        dd($data);
        //当前分类的子分类
        $submenu=Category::where('cate_pid',$cate_id)->get();
//        dd($submenu);
        //查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');


        return view('home.list',compact('field','data','submenu'));
    }

    public function article($art_id)
    {
        $field=Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
//        dd($field);
        $article['pre']=Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next']=Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
//        dd($article);

        $data=Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();
//        dd($data);

        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');

        return view('home.new',compact('field','article','data'));
        
    }


}
