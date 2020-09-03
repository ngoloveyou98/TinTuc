<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\Slide;
use App\TheLoai;
class SlideController extends Controller
{
    public function getDanhSach()
    {
       $slide = Slide::all();
       return view('admin/slide/danhsach',['slide'=>$slide]);
    }
    
    public function getThem()
    {
        return view('admin.slide.them');

    }
    public function postThem(Request $request)
    {
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required'
        ],
        [
           'Ten.required'=>'Bạn chưa nhập Tên',
           'NoiDung.required'=>'Bạn chưa nhập nội dung' 
        ]);
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }
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
            $file->move("upload/slide",$hinh);
            
            $slide->Hinh = $hinh;

        }else{
            $slide->Hinh = '';
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Đã thêm thành công');
    }
    public function getSua($id)
    {
        $slide  = Slide::find($id);
        return view('admin/slide/sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required'
        ],
        [
           'Ten.required'=>'Bạn chưa nhập Tên',
           'NoiDung.required'=>'Bạn chưa nhập nội dung' 
        ]);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }
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
            $file->move("upload/slide",$hinh);
            unlink("upload/slide/$slide->Hinh");
            $slide->Hinh = $hinh;

        }
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao','Đã sửa thành công');
    }
    public function getXoa($id)
    {
        Slide::where('id',$id)->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','đã xóa thành công');
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
