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
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view ('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
       $this->validate($request,
       [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:tintuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'

       ],
       [
            'LoaiTin.required'=>'Mời bạn chọn loai tin',
            'TieuDe.required'=>'Mời bạn nhập tiêu đề ',
            'TieuDe.min'=>'Tiêu đề phải nhiều hơn 3 kí tự',
            'TomTat.required'=>'Mời bạn nhập tóm tắt',
            'NoiDung.required'=>'Mời bạn nhập nội dung',

       ]);
       $tintuc = new TinTuc();
       $tintuc->TieuDe = $request->TieuDe;
       $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    //    echo changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->SoLuotXem = 0;
        $tintuc->NoiBat = $request->NoiBat;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi','bạn chỉ được chọn 1 trong các file: png jpg jpeg');
            }
            $hinh = time()."_$name";
            // while(file_exists('upload/tintic/'.$hinh)){
            //     $hinh = time()."_$name";
            // }
            $file->move("upload/tintuc",$hinh);
            $tintuc->Hinh = $hinh;

        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Đã thêm thành công');

    }
    public function getSua($id)
    {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin/tintuc/sua',['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id)
    {
        $tintuc = TinTuc::find($id);
        $this->validate($request,
        [
             'LoaiTin'=>'required',
             'TieuDe'=>'required|min:3|unique:tintuc,TieuDe',
             'TomTat'=>'required',
             'NoiDung'=>'required'
 
        ],
        [
             'LoaiTin.required'=>'Mời bạn chọn loai tin',
             'TieuDe.required'=>'Mời bạn nhập tiêu đề ',
             'TieuDe.unique'=>'Tiêu đề đã tồn tài',
             'TieuDe.min'=>'Tiêu đề phải nhiều hơn 3 kí tự',
             'TomTat.required'=>'Mời bạn nhập tóm tắt',
             'NoiDung.required'=>'Mời bạn nhập nội dung',
 
        ]);
        
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
     //    echo changeTitle($request->TieuDe);
         $tintuc->TomTat = $request->TomTat;
         $tintuc->NoiDung = $request->NoiDung;
         $tintuc->idLoaiTin = $request->LoaiTin;
         $tintuc->SoLuotXem = 0;
         $tintuc->NoiBat = $request->NoiBat;
         if($request->hasFile('Hinh')){
             $file = $request->file('Hinh');
             $name = $file->getClientOriginalName();
             $duoi = $file->getClientOriginalExtension();
             if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg'){
                 return redirect('admin/tintuc/them')->with('loi','bạn chỉ được chọn 1 trong các file: png jpg jpeg');
             }
             $hinh = time()."_$name";
             // while(file_exists('upload/tintic/'.$hinh)){
             //     $hinh = time()."_$name";
             // }
             $file->move("upload/tintuc",$hinh);
             unlink("upload/tintuc/".$tintuc->Hinh);
             $tintuc->Hinh = $hinh;
 
         }
         $tintuc->save();
         return redirect('admin/tintuc/sua')->with('thongbao','Đã sửa thành công');
    }
    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        if(!isset($tintuc->comment)){
            return redirect('admin/tintuc/danhsach')->with('thongbao',"xóa thành công");
            $tintuc->delete();

        }else{
            // $tintuc->delete();
            return redirect('admin/tintuc/danhsach')->with('loixoa','xóa thành công');
            
        }
    } 

    // danh sach xoa
    public function getDanhSachXoa()
    {
        $tintuc = TinTuc::onlyTrashed()->get();
        return view('admin.tintuc.danhsachxoa',['tintuc'=>$tintuc]);
    }

    public function getXoaVV($id)
    {
        $tintuc = TinTuc::find($id);
        if(count($tintuc->comment)==0){
            Tintuc::withTrashed()->where('id',$id)->forceDelete();
            return redirect('admin/tintuc/danhsachxoa')->with('thongbao','Đã xóa thành công');
         }else {
            return redirect('admin/tintuc/danhsachxoa')->with('loixoa','Không được xóa');

         }
    }

    public function getRestore($id)
    {
        
        TinTuc::withTrashed()->where('id',$id)->restore();
        return redirect('admin/tintuc/danhsachxoa')->with('thongbaoRestore','Khôi phục thành công');
    }
}
