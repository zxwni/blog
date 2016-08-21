<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class Navs extends Model
{
    protected $table='navs';
    protected $primaryKey='nav_id';
    public $timestamps=false;
    protected $guarded=[];  //guarded填写敏感字段(不能填写的字段)，fillable填写可以填写的字段


}