<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(){
        $pdo=DB::connection()->getPdo();
        dd($pdo);
    }
    public function select(){
        $arr=DB::select("select * from user");
        dd($arr);
    }
}
