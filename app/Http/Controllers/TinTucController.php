<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
class TinTucController extends Controller
{
    public function getDanhSach()
    {
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    
    public function getThem()
    {
        

    }
    public function postThem(Request $request)
    {
       
    }
    public function getSua($id)
    {
        
    }
    public function postSua(Request $request,$id)
    {
       
    }
    public function getXoa($id)
    {
        
    } 

    // danh sach xoa
    public function getDanhSachXoa()
    {
        
    }

    public function getXoaVV($id)
    {
        
    }

    public function getRestore($id)
    {
        

    }
}
