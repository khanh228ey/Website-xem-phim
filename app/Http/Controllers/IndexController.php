<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function home(){
        $categoryHome = Category::with('movie')->WHERE('status','1')->orderBy('id','ASC')->Get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $hotMovie = Movie::orderBy('id','DESC')->where('phimhot',1)->get();
        $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
        return view('pages.home',compact('categoryHome','categoryNav','genre','country','hotMovie','getViewThang','getViewTuan','getViewQuy'));
    }

    public function getCategory($slug){
        $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $cateSlug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cateSlug->id)->paginate(40);
        $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
        return view('pages.category',compact('categoryHome','genre','country','cateSlug','categoryNav','movie','getViewThang','getViewTuan','getViewQuy'));
    }

    public function getGenre($slug){
        $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $genreSlug = Genre::where('slug',$slug)->first();
        $manyGenre = [];
        $movieGenre = Movie_Genre::where('genre_id',$genreSlug->id)->get();
        foreach($movieGenre as $mvGenre){
            $manyGenre[] = $mvGenre->movie_id;
        }
        $movie = Movie::whereIn('id',$manyGenre)->orderBy('ngayUpdate')->paginate(40);
        $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
        return view('pages.genre',compact('categoryHome','genre','country','genreSlug','categoryNav','movie','getViewThang','getViewTuan','getViewQuy'));
    }

    public function getCountry($slug){
        $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $countrySlug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$countrySlug->id)->paginate(40);
        $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
        $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
        $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
        return view('pages.country',compact('categoryHome','genre','country','countrySlug','categoryNav','movie','getViewThang','getViewTuan','getViewQuy'));
    }

    public function getMovie($slug){
        $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $getMovie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $getEpisode = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','DESC')->take(3)->GET();
        $movieRelated = Movie::with('category')->where('category_id',$getMovie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->limit(8)->Get();
        $episodeFirst = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','ASC')->TAKE(1)->first();
        $episode = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','ASC')->get();
        $getRating = Rating::where('movie_id',$getMovie->id)->avg('rating');
        $rating = round($getRating);
        $count_total = Rating::where('movie_id',$getMovie->id)->count();
        $demLuotQuanTam = $getMovie->luotquantam;
        $tangLuotQuanTam = $demLuotQuanTam + 1;
        $getMovie->luotquantam = $tangLuotQuanTam;
        $getMovie->save();
        return view('pages.movie',compact('categoryHome','genre','country','getMovie','categoryNav','getEpisode','movieRelated','episodeFirst','episode','rating','count_total'));
    }

    public function addRating(Request $request){
        $data = $request->all();
        $ip_address = $request->ip();
        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('ip_address',$ip_address)->count();
        if($rating_count >0){
            echo 'exist';
        }else{
            $rating = new Rating();
            $rating->movie_id = $data['index'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
    }

    public function searchMovie(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
            $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
            $genre = Genre::orderBy('id','DESC')->GET();
            $country = Country::orderBy('id','DESC')->GET();
            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('ngayUpdate','DESC')->paginate(40);
            $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
            $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
            $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
            return view('pages.search',compact('search','categoryHome','genre','country','categoryNav','movie','getViewThang','getViewTuan','getViewQuy'));
        }
        else{
            return redirect()->to('/');
            }
        }
    public function watchMovie($slug,$tap){
        if(isset($tap)){
            $tapphim = $tap;
        }else{
            $tapphim = 1;
        }
            $tapphim = substr($tap,4,1);
            $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
            $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
            $genre = Genre::orderBy('id','DESC')->GET();
            $country = Country::orderBy('id','DESC')->GET();
            $getViewTuan = Movie::where('topview',1)->orderBy('id','DESC')->limit(8)->GET();
            $getViewThang = Movie::where('topview',2)->orderBy('id','DESC')->limit(8)->GET();
            $getViewQuy = Movie::where('topview',3)->orderBy('id','DESC')->limit(8)->GET();
            $getMovie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->first();
            $movieRelated = Movie::with('category')->where('category_id',$getMovie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->limit(8)->Get();
            $getEpisode = Episode::where('movie_id',$getMovie->id)->where('sotap',$tapphim)->first();
            return view('pages.watch',compact('categoryHome','genre','country','categoryNav','getViewThang','getViewTuan','getViewQuy','getMovie','movieRelated','getEpisode','tapphim'));
    }
    public function episode(){ $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        return view('pages.episode',compact('categoryHome','genre','country','categoryNav'));

    }
    

}
