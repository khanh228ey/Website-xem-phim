<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class IndexController extends Controller
{
    //
    public function home(){
        $info = Info::find(1);
        
        $categoryHome = Category::with('movie')->WHERE('status',1)->orderBy('id','ASC')->limit(16)->Get();
        return view('pages.home',compact('categoryHome'));
    }

    public function getCategory($slug){
        $cateSlug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cateSlug->id)->paginate(40);
        return view('pages.category',compact('cateSlug','movie'));
    }

    public function getGenre($slug){
        $genreSlug = Genre::where('slug',$slug)->first();
        $manyGenre = [];
        $movieGenre = Movie_Genre::where('genre_id',$genreSlug->id)->get();
        foreach($movieGenre as $mvGenre){
            $manyGenre[] = $mvGenre->movie_id;
        }
        $movie = Movie::whereIn('id',$manyGenre)->orderBy('ngayUpdate','DESC')->paginate(40);
        return view('pages.genre',compact('genreSlug','movie'));
    }

    public function getCountry($slug){
        $countrySlug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$countrySlug->id)->paginate(40);
        return view('pages.country',compact('countrySlug','movie'));
    }

    public function getMovie($slug){
        $getMovie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $getEpisode = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','DESC')->take(3)->GET();
        $movieRelated = Movie::with('category')->where('category_id',$getMovie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->limit(8)->Get();
        $episodeFirst = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','ASC')->TAKE(1)->first();
        $episode = Episode::with('movie')->where('movie_id',$getMovie->id)->orderBy('sotap','ASC')->count();
        $getRating = Rating::where('movie_id',$getMovie->id)->avg('rating');
        $rating = round($getRating);
        $count_total = Rating::where('movie_id',$getMovie->id)->count();
        $demLuotQuanTam = $getMovie->luotquantam;
        $tangLuotQuanTam = $demLuotQuanTam + 1;
        $getMovie->luotquantam = $tangLuotQuanTam;
        $getMovie->save();
        return view('pages.movie',compact('getMovie','getEpisode','movieRelated','episodeFirst','episode','rating','count_total'));
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
            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('ngayUpdate','DESC')->paginate(40);
            return view('pages.search',compact('search','movie'));
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
            $getMovie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->first();
            $movieRelated = Movie::with('category')->where('category_id',$getMovie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->limit(8)->Get();
            $getEpisode = Episode::where('movie_id',$getMovie->id)->where('sotap',$tapphim)->first();
            $demLuotxem = $getMovie->luotxem;
            $tangLuotXem = $demLuotxem + 1;
            $getMovie->luotxem = $tangLuotXem;
            $getMovie->save();
            return view('pages.watch',compact('getMovie','movieRelated','getEpisode','tapphim'));
    }
    public function episode(){ $categoryHome = Category::orderBy('id','ASC')->WHERE('status',1)->get();
        $categoryNav = Category::orderBy('id','ASC')->WHERE('status',1)->Get();
        $genre = Genre::orderBy('id','DESC')->GET();
        $country = Country::orderBy('id','DESC')->GET();
        $getInfoWeb = Info::find(1);
        return view('pages.episode',compact('categoryHome','genre','country','categoryNav','getInfoWeb'));

    }
    

}
