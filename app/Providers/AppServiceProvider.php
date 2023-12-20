<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Info;
use App\Models\Movie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $hotMovie = Movie::orderBy('id','DESC')->where('phimhot',1)->limit(20)->get();
        $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(10)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(10)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(10)->GET();
        $getInfoWeb = Info::find(1);
        $title = $getInfoWeb->title;
        $description = $getInfoWeb->description;
        View::share([
            'categoryNav' => $categoryNav,
            'genre' => $genre,
            'country'=> $country,
            'hotMovie' => $hotMovie,
            'getViewTuan'=> $getViewTuan,
            'getViewThang'=> $getViewThang,
            'getViewQuy'=> $getViewQuy,
            'getInfoWeb' => $getInfoWeb,
            'metaTitle' => $title,
            'metaDescription' => $description
        ]);
    }
}
