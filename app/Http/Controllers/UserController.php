<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use App\User;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    
    public function getThem()
    {
        return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:3|max:20',
        'passwordAgain'=>'required|same:password'
      ],
      [
        'name.required'=>'Bạn chưa nhập Tên',
        'email.required'=>'Bạn chưa nhập email',
        'email.email'=>'Email bạn nhập chưa đúng định dạng',
        'email.unique'=>'Email đã tồn tại',
        'password.required'=>'Bạn chưa nhập password',
        'password.min'=>'Mật khẩu phải từ 3 - 20 kí tự',
        'password.max'=>'Mật khẩu phải từ 3 - 20 kí tự',
        'passwordAgain.required'=>'Mời bạn nhập lại mật khẩu',
        'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
      ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Đã thêm thành công');
    }
    public function getSua($id)
    {
        $user= User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            
          ],
          [
            'name.required'=>'Bạn chưa nhập Tên',
            
          ]);
    
            $user =  User::find($id);
            $user->name = $request->name;
            $user->quyen = $request->quyen;
            
            if($request->changePassword == 'on'){
                $this->validate($request,[
                    
                    'password'=>'required|min:3|max:20',
                    'passwordAgain'=>'required|same:password'
                  ],
                  [
                    'password.required'=>'Bạn chưa nhập password',
                    'password.min'=>'Mật khẩu phải từ 3 - 20 kí tự',
                    'password.max'=>'Mật khẩu phải từ 3 - 20 kí tự',
                    'passwordAgain.required'=>'Mời bạn nhập lại mật khẩu',
                    'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
                  ]);

                $user->password = $request->password;
            }
            $user->save();
            return redirect('admin/user/danhsach')->with('thongbao','Đã sửa thành công');
    }
    public function getXoa($id)
    {
        User::where('id',$id)->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Đã xóa thành công');
    }


    // danh sach xoa
    public function getDanhSachXoa()
    {
        $user = User::onlyTrashed()->get();
        return view('admin.user.danhsachxoa',['user'=>$user]);
    }
    public function getXoaVV($id)
    {
        
    }

    public function getRestore($id)
    {
        
        
    }

    // del comment
    public function getDelComment($id,$idTinTuc)
    {
        Comment::find($id)->delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Đã Xóa thành công');
    }
}
