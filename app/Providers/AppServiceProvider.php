<?php

namespace App\Providers;

use App\Slide;
use App\TheLoai;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // add: default varchar(191)
        $theloai= TheLoai::all();
        view()->share('theloai',$theloai);
        $slide = Slide::all();
        view()->share('slide',$slide);
    }
}
