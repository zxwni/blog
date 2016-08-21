<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class Links extends Model
{
    protected $table='links';
    protected $primaryKey='link_id';
    public $timestamps=false;
    protected $guarded=[];  //guarded填写敏感字段(不能填写的字段)，fillable填写可以填写的字段


}