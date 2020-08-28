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
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');
        

        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');

        Route::get('xoa/{id}','TheLoaiController@getXoa');
        


    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua','TheLoaiController@getSua');

        Route::get('them','TheLoaiController@getThem');

    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua','TheLoaiController@getSua');

        Route::get('them','TheLoaiController@getThem');
        

    });
});
