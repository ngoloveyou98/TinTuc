<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use App;
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});
Route::get('demo', function () {
    return 'hello';
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach','TheLoaiController@getDanhSach');
        Route::get('danhsachxoa', 'TheLoaiController@getDanhsachxoa');
        Route::get('danhsachxoa/xoa/{id}','TheLoaiController@getXoaVV') ;
        Route::get('danhsachxoa/restore/{id}','TheLoaiController@getRestore') ;

        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');
        

        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');

        Route::get('xoa/{id}','TheLoaiController@getXoa');



    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach','LoaiTinController@getDanhSach');
        Route::get('danhsachxoa','LoaiTinController@getDanhSachXoa');
        Route::get('danhsachxoa/xoa/{id}','LoaiTinController@getXoaVV') ;
        Route::get('danhsachxoa/restore/{id}','LoaiTinController@getRestore') ;

        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');


        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');

        Route::get('xoa/{id}','LoaiTinController@getXoa');

        

    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach','TinTucController@getDanhSach');
        Route::get('danhsachxoa','TinTucController@getDanhSachXoa');
        Route::get('danhsachxoa/xoa/{id}','TinTucController@getXoaVV') ;
        Route::get('danhsachxoa/khoiphuc/{id}','TinTucController@getRestore') ;
        Route::get('sua/{id}','TinTucController@getSua')
        ;
        Route::post('sua/{id}','TinTucController@postSua');

        Route::get('them','TinTucController@getThem');
        Route::post('them','TinTucController@postThem');


        Route::get('xoa/{id}','TinTucController@getXoa');
        
        
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', "AjaxController@getLoaiTin");
    });
    
});
