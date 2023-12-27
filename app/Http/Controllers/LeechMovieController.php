<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LeechMovieController extends Controller
{
    //
    public function leechMovie(Request $request){
        
        $resp = Http::withOptions(['verify' => false])->get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1");
            // $data = $resp->json();
        return view('admincp.movie.leechmovie',compact('resp'));
    }

    public function addMovie(Request $request,string $slug){
        $resp = Http::withOptions(['verify' => false])->get("https://ophim1.com/phim/".$slug);
            $checkMovie = Movie::where('slug',$slug)->FIRST();
        if($checkMovie){
            toastr()->error('Thêm thất bại','Phim đã có không thể thêm');
            return redirect()->route('leechMovie');
        }
        else{
        $resp_movie[] = $resp['movie'];
        $movie = new Movie();
        foreach($resp_movie as $key => $res){
            $movie->title =$res['name'];
            $movie->description =$res['content'];
            $movie->tags =$res['name'].','.$res['slug'];
            $movie->name_eng =$res['origin_name'];
            $movie->resolution = 0;
            $movie->duration =$res['time'];
            if(!is_numeric($res['episode_total'])){
                $movie->sotap=0;
            }else{
                $movie->sotap =$res['episode_total'];
            }
            $movie->phude = 0;
            $movie->year = $res['year'];
            $movie->slug =$res['slug'];
            $movie->trailer = $res['trailer_url'];
            $movie->status = 0;
            $movie->thuocphim =rand(1,2);
            $category = Category::orderby('id','DESC')->FIRST();
            $movie->category_id = $category->id;
            $genre = Genre::orderby('id','DESC')->FIRST();
            $movie->genre_id = $genre->id;
            $country = Country::orderby('id','DESC')->first();
            $movie->country_id = $country->id;
            $movie->phimhot = 0;
            $movie->ngayTao = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->image = $res['thumb_url'];
            $movie->save();
            $movie->movie_genre()->attach($genre);
        }
        toastr()->success('Thêm thành công','Thêm thành công');
        return redirect()->route('movie.index');
        
    }
    }
    
    // public function leechEpisode(){

    // }
    // public function addEpisode(){
    //     $resp = Http::withOptions(['verify' => false])->get("https://ophim1.com//phim".$slug);
    //         // $data = $resp->json();
    //     return view('admincp.movie.leechmovie',compact('resp'));
    // }
}
