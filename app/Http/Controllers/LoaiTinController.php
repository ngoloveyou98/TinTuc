<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    public function getDanhSach()
    {
        $loaitin = LoaiTin::with('TheLoai')->get();
        // dd($loaitin);
       return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]); 
    }
    
    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);

    }
    public function postThem(Request $request)
    {
        $this->validate($request,[
            'TenLoaiTin' => 'required|min:2|max:100|unique:loaitin,ten',
            'TheLoai' =>'required'
        ],
        [
            'TenLoaiTin.required'=>'Bạn chưa nhập tên loại tin',
            'TenLoaiTin.unique' => 'Ten loại tin đã tồn tại',

            'TenLoaiTin.min' => 'Tên loại tin phải có ít nhất 2 kí tự',
            'TenLoaiTin.max' => 'Ten loại tin không vươt quá 100 kí tự',
            "TheLoai.required" =>'Vui lòng chọn thể loại'
        ]);
        
        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->TenLoaiTin;
        $loaitin->TenKhongDau = changeTitle($request->TenLoaiTin);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Đã Thêm thành công');
    }
    public function getSua($id)
    {
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
       $this->validate($request,[
            'TenLoaiTin'=>'required|min:2|max:100|unique:loaitin,Ten',
            'TheLoai'=>'required'
       ],
       [
            'TenLoaiTin.required'=>'Bạn chưa nhập tên loại tin',
            'TenLoaiTin.min' => 'Tên loại tin phải có ít nhất 2 kí tự',
            'TenLoaiTin.max' => 'Ten loại tin không vươt quá 100 kí tự',
            'TenLoaiTin.unique' => 'Ten loại tin đã tồn tại',
            
            "TheLoai.required" =>'Vui lòng chọn thể loại'
       ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->TenLoaiTin;
        $loaitin->TenKhongDau = changeTitle($request->TenLoaiTin);
        // echo changeTitle($request->TenLoaiTin);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','đã sửa thành công');
    }
    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        if(!isset($loaitin->tintuc)){
            LoaiTin::where('id',$id)->delete();
            return redirect('admin/loaitin/danhsach')->with('thongbao','đã xóa thành công');
        }else {
            return redirect('admin/loaitin/danhsach')->with('thongbao','Không được xóa');
        }
        
    } 

    // danh sach xoa
    public function getDanhSachXoa()
    {
        $loaitin = LoaiTin::onlyTrashed()->get();
        return view('admin/loaitin/danhsachxoa',['loaitin'=>$loaitin]);
    }

    public function getXoaVV($id)
    {
        LoaiTin::withTrashed()->where('id',$id)->forceDelete();
        return redirect("admin/loaitin/danhsachxoa")->with('thongbao','Xóa thành công');
    }

    public function getRestore($id)
    {
        LoaiTin::withTrashed()->where('id', $id)->restore();
        return redirect("admin/loaitin/danhsachxoa")->with('thongbao','Khôi phục thành công');

    }
}
