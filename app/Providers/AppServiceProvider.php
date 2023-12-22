<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
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
        //admin
        $monthStart = now()->startOfMonth(); // Lấy ngày đầu tiên của tháng hiện tại
        $monthEnd = now()->endOfMonth();     // Lấy ngày cuối cùng của tháng hiện tại
        $moviesAddedThisMonth = Movie::whereBetween('ngayTao', [$monthStart, $monthEnd])->count();
        $totalViewsThisMonth = Movie::whereBetween('ngayTao', [$monthStart, $monthEnd])->sum('luotxem');
        $movieTotal = Movie::all()->count();
        $episodeTotal = Episode::all()->count();


        //pages
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $hotMovie = Movie::orderBy('ngayUpdate','DESC')->where('phimhot',1)->limit(20)->get();
        $getViewTuan = Movie::where('topview',1)->orderBy('ngayUpdate','DESC')->limit(15)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('ngayUpdate','DESC')->limit(15)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('ngayUpdate','DESC')->limit(15)->GET();
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
            'metaDescription' => $description,


            //admin   
            'movieTotal' => $movieTotal,
            'episodeTotal' => $episodeTotal,
            'movieCreateMonth' => $moviesAddedThisMonth ,
            'totalViewsThisMonth' => $totalViewsThisMonth      
        ]);
    }
}
