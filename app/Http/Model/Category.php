<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;
    protected $guarded=[];  //guarded填写敏感字段(不能填写的字段)，fillable填写可以填写的字段

    public function tree()
    {

        $categories=$this->orderBy('cate_order','asc')->get();
//        dd($categories);
        $cate=$this->getTree($categories,'cate_name','cate_id','cate_pid');
        return $cate;
    }
    
    
    
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



}