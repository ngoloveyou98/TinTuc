<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
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
}
