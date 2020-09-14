<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use App\User;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class PageController extends Controller
{
    public function getHomepages()
    {
        
        return view('pages.homepages');
    }
    public function getContact()
    {
        // $theloai = TheLoai::all();
        return view('pages.contact');
    }
    public function getLoaiTin($id)
    {
        # code...
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function getTinTuc($id)
    {
        # code...
        $tintuc = TinTuc::find($id);
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinlienquan'=>$tinlienquan,'tinnoibat'=>$tinnoibat]);
    }
    public function getDangNhap()
    {
        # code...
        return view('pages.dangnhap');
    }
    public function postDangNhap(Request $request)
    {
        # code...
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3|max:20"'
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mẩu khẩu phải từ 3-20 kí tự',
            'password.max'=>'Mẩu khẩu phải từ 3-20 kí tự'
        ]);
        if(Auth::attempt(['email' =>$request->email, 'password' => $request->password])){
            return redirect('homepages');
        }else{
            return redirect('dangnhap')->with('thongbao','Tài khoản hoặc mật khẩu sai');
        } 
    }

    public function getDangXuat()
    {
        # code...
        Auth::logout();
        return redirect('homepages');
    }

    public function getComment($id, Request $request)
    {
        $tintuc = TinTuc::find($id);
        $comment = new Comment();
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();
        return redirect("tintuc/$id/$tintuc->TieuDeKhongDau.html");
    }

    //User
    public function getUser()
    {
        # code...
        return view('pages.user');
    }
    public function postUser(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],
        [
            'name.required'=>'Họ Tên không được để trống',
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
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
              $user->password = bcrypt($request->password);
            
        }
        $user->save();

        return redirect('user')->with('thongbao','Cập Nhập thành công');
    }

    // Register
    public function getRegister()
    {
        # code...
        return view('pages.dangky');
    }
    public function postRegister(Request $request)
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
            
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('homepages')->with('thongbao','Đã đăng kí thành công');# code...
    }
}
