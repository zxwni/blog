<?php namespace App\Http\Controllers\Admin;



use App\Http\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //展示配置
    public function index()
    {
        $data=Config::orderBy('conf_order','asc')->get();
        foreach($data as $k => $v){
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html='<input class="lg" type="text" name="conf_content[]" value="'.$v->conf_content.'"/>';
                    break;
                case 'textarea':
                    $data[$k]->_html='<textarea class="lg" type="text" name="conf_content[]" >'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr=explode(',',$v->field_value);
                    $str='';
                    echo $v->content;
                   foreach($arr as $m=>$n){
                      $r=explode('|',$n);
                       $c=$v->conf_content ==$r[0] ? ' checked ':'';
                      $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'&nbsp;&nbsp;&nbsp;';
                   }
                    $data[$k]->_html=$str;
                    break;
            }
        }



        return view('admin.config.index',compact('data'));
    }
    //排序
    public function changeorder(Request $request)
    {
        $res=$request->all();
        $conf_id=$res['conf_id'];
        $conf_order=$res['conf_order'];
        $li=Config::find($conf_id);
        $li->conf_order=$conf_order;
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


    //添加配置项页面
    public function create()
    {
        return view('admin.config.add');
    }

    //添加配置处理
    public function store(Request $request)
    {
        $input=$request->except('_token');
        if(!$input){
            return view('admin.config.add');
        }else{
            $rules=[
                'conf_name'=>'required',
                'conf_title'=>'required',
            ];
            $message=[
                'conf_name.required'=>'配置项名称不能为空',
                'conf_title.required'=>'配置项标题不能为空',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re= Config::create($input);
                if($re){
                    return redirect('admin/config');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }


    //更新配置项页面
    public function edit($conf_id)
    {
        $field=Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }
    //更新配置项处理
    public function update(Request $request,$conf_id)
    {
        $input=$request->except('_token','_method');
        if(!$input){
            return view('admin.config.edit');
        }else{
            $rules=[
                'conf_name'=>'required',
                'conf_title'=>'required',
            ];
            $message=[
                'conf_name.required'=>'配置项名称不能为空',
                'conf_title.required'=>'配置项标题不能为空',

            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re=Config::where('conf_id',$conf_id)->update($input);
                if($re){
                    return redirect('admin/config');
                }else{
                    return redirect()->back()->with('msg','数据添加失败，请稍后重试');
                }
            }else{
                return redirect()->back()->withErrors($validator->errors());
            }
        }
    }

    //删除配置项
    public function delete($conf_id)
    {
        $re=Config::where('conf_id',$conf_id)->delete();
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


    //配置项内容更改
    public function changecontent(Request $request)
    {
        $input =$request->all();
        foreach($input['conf_id'] as $k=>$v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        return redirect()->back()->with('msg','更新成功');
    }

    //从数据库导出配置项内容，并导入conf文件中
    public function putFile()
    {

        $config=Config::pluck('conf_content','conf_name')->all();
        $path=base_path().'\config\web.php';
        $str='<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }



}
