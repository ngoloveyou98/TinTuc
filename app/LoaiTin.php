<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaiTin extends Model
{
    use SoftDeletes;
    protected $table = 'loaitin';
    protected $primaryKey = 'id';
    protected $fillable = ['id','idTheLoai','Ten','TenKhongDau']; 
    public function tintuc(){
        return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
    public function theloai()
    {
        #...
        return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }
}
