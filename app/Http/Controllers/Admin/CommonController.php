<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function uploadfile(Request $request)
    {
        $file=Input::file('Filedata');

        if($file->isValid()){
            $extension=$file->getClientOriginaExtension();
            $newName=data('YmdHis').mt_rand(100,999).'.'.$extension;
            $path=$file->move(base_path().'/uploads',$newName);
            $filepath='upload/'.$newName;
            return $filepath;
        }

    }
}
