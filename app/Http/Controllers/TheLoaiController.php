<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai' => $theloai]);
    }
    
    public function getThem()
    {
        # code...
        return view('admin.theloai.them');

    }
    public function postThem(Request $request)
    {
        $this->validate($request,
        [
            'Ten' => 'required|min:2|max:100'
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên thể loại',
            'Ten.min' => 'Tên thể loại phải nhiều hơn 2 kí tự',
            'Ten.max' => 'Tên thể loại phải ít  hơn 100 kí tự',

        ]);

        $theloai = new TheLoai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        // echo changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Đã Thêm thành công');

    }
    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,
        [
            'Ten'=>'required| unique:TheLoai,Ten|min:2|max:100'
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên thể loại',
            'Ten.unique' => 'Tên thể loại đã tồn tại',
            'Ten.min' => 'Tên thể loại phải nhiều hơn 2 kí tự',
            'Ten.max' => 'Tên thể loại phải ít  hơn 100 kí tự',
        ]);
        $theloai =  TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$theloai->id)->with('thongbao','Bạn đã sửa thành công');
    
    }
    public function getXoa($id)
    {
        TheLoai::where('id',$id)->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa thành công');
    }
}
