# blog
lumen's blog project

lunmen 笔记

一.接收表单数据并判断
$input=$request->except('_token');
if(!$input){
	return view('admin.category.add');
}else{
	if(!$input['cate_pid']){
		$input['cate_pid']=0;
	}
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
二.传递数据到模板
$data=Article::orderBy('art_id','desc')->paginate(5);
return view('admin.article.index',compact('data'));

三.分页
后台传 	   $data=Article::orderBy('art_id','desc')->paginate(5);
		   return view('admin.article.index',compact('data'));
前台接收    {!! $data->render() !!}
		
四. 将数据存到session中 或者 删除session中的
存：  $request->session()->put('user', "$user");
删：  $request->session()->forget('user');

五. 二级目录方法
在模板中：

	//二级目录
	public function getTree($data,$file_name,$file_id='id',$file_pid='pid',$pid=0)
	{
		$arr=array();
		foreach($data as $k=>$v){
			if($v[$file_pid] == $pid){
				$data[$k]["_".$file_name]=$data[$k]["$file_name"];
				$arr[]=$data[$k];
				foreach ($data as $m => $n) {
					if($n->$file_pid==$v->$file_id){
						$data[$m]["_".$file_name]='--  '.$data[$m]["$file_name"];
						$arr[]=$data[$m];
					}
				}
			}
		}
	//        dd($arr);
		return $arr;
	}
	调用这个方法
public function tree()
{
	$categories=$this->orderBy('cate_order','asc')->get();
	// dd($categories);
	$cate=$this->getTree($categories,'cate_name','cate_id','cate_pid');
	return $cate;
}
在控制器中
	$data=(new Category)->tree();
    return view('admin.category.index',compact('data'));

六.图片上传方法
public function upload()
{
	$bpath=base_path();
	$uploaddir=$bpath.'/upfiles/';  //文件保存目录
	$filename=$_FILES['art_thumb']['name']; //上传的文件名
	$temppath=$_FILES['art_thumb']['tmp_name']; //上传的临时路径
	$type=array('jpg','gif','bmp','jpeg','png'); //限制上传的类型
	$fileext=strtolower(substr(strstr($filename,'.'),1)); //获取上传文件后缀名
	if(!in_array($fileext,$type)){
		$text=implode(",",$type);
		return redirect()->back()->with('msg',"只能上传一下类型文件:".$text."<br>");
	}else{
		$filename=explode(".",$filename);
		do{
			$filename[0]=time();
			$name=implode(".",$filename);
			$uploadfile=$uploaddir.$name;
		}while(file_exists($uploadfile));
		if(move_uploaded_file($temppath,$uploadfile)){
			if(is_uploaded_file($temppath)){
				return redirect()->back()->with('msg',"上传失败");
			}
		}
	}
	$uploadfile=str_replace("$bpath",'',$uploadfile); //指定到根目录中
	return $uploadfile; //最终文件路径名
}

七.如果数据有共享可以写到commonController(继承Controller,其他控制器在继承它)中
 public function __construct()
{
	$navs=Navs::all();
	//点击量最高5篇的文章(右边栏中)
	$hot2=Article::orderBy('art_view','desc')->take(5)->get();
	//8条最新文章
	$new=Article::orderBy('art_time','desc')->take(8)->get();
	View::share('navs',$navs);   //共享到每个页面
	View::share('hot2',$hot2);	 
	View::share('new',$new);
}

八.路由写法
$app->group(['namespace'=>'App\Http\Controllers\Home'],function($app){   //命名空间相同
    $app->get('/','IndexController@index');      						 //调用控制器
    $app->get('/a/{art_id}','IndexController@article');					 //待参数
});

$app->group(['middleware'=>'adminlogin','prefix'=>'admin','namespace'=>'App\Http\Controllers\Admin'],function ($app){
			 //调用中间键 adminlogin      共用前缀			 共用命名空间
   $app->get('index','IndexController@index');
   $app->post('upload','CommonController@uploadfile');
});
		
九.中间键
在/bootstrap/app.php中加上
 $app->routeMiddleware([
    'adminlogin'=>'App\Http\Middleware\AdminLogin',
 ]);
在/middleware/AdminLogin.php文件中
<?php namespace App\Http\Middleware;
use Closure;
class AdminLogin {
public function handle($request, Closure $next)
{
	if(!($request->session()->has('user'))){   //判断seesion中是否有user
		return redirect('admin/login');			//没有返回
	}else{
		return $next($request);					//有，继续运行
	}
}

}
?>

十.模板
(1).父级模板： (layouts/admin)
	将公用的提取出来
	@yield('content') -- 》不同的代码            
-->	@section('content') @show ---》将父模板中的这之间的代码载入到子模板中

(2).子模板中:
	@extends('layouts.admin')
	@section('content') 
	@endsection
--> @section('content')  @parent @endsection

(3).表单中csrf验证
<input type="hidden" name="_token" value="{{ csrf_token() }}">

(4).更改表单提交方式
 <input type="hidden" name="_method" value="put" />

(5).模版中引用地址
 {{url('admin/login')}}

(6).模版中验证数据
 @if(session('msg'))
	<p style="color: red"><?php  echo session('msg')?></p>
@endif
@if(count($errors)>0)
@foreach($errors->all() as $error)
	<p style="color: red">{{$error}}</p>
@endforeach
@endif

(7).不解析
 {!! $field->_html !!}


十一.数据库操作
增：
 $re= Category::create($input); 插入表单传过来的数据
 Category::where('cate_id',$cate_id)->increment('cate_view'); //调用一次cate_view自增一

删:
 $re=Article::where('art_id',$art_id)->delete(); //删除

改：
 $re=Article::where('art_id',$art_id)->update($input);//更新全部传递的数据

$cate=Category::find($cate_id);			//取出数据对象
$cate->cate_order=$cate_order;			//更改其中一条数据
$re=$cate->update();					//更新数据

Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]); //上面三个可以一起写

查：
  // $attributes = [
	// 'uname' => "$getname",
 // ];
 // $user = User::firstByAttributes($attributes); //从user表中取出uname等于接收到的名字的这个行数据

$art=User::where('uname',$getname)->get()->first(); //取一条对象
$art=User::where('uname',$getname)->get()->all(); //取全部组成数组
$art=User::where('uname',$getname)->get();  //取出一条对象数组

$art=User::orderBy('uid','desc')->get();  //按uid排序取出数据
$hot2=Article::orderBy('art_view','desc')->take(5)->get();//根据排序取出指定条数据
$user=User::where('uid','>','18')->orderBy('uid','desc')->get(); //可以组合使用
$data=Category::find($cate_id); //根据主键获取数据对象


$field=Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
//Article表 连接Category表 连接条件 article.cate_id==category.cate_id 取出指定art_id 的一条数据对象






