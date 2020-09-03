<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TheLoai extends Model
{
    use SoftDeletes;
    protected $table = 'theloai';
    
    public function loaitin(){
        return $this->hasMany('App\LoaiTin' , 'idTheLoai','id');
     }

    public function tintuc(){
        return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
