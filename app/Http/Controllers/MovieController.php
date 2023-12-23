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

use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

use function Laravel\Prompts\alert;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $list = Movie::with('category','movie_genre','country','episode')
        // ->withCount('episode')
        // ->selectRaw('movie.*, SUM(episode.luotXem) as total_views')
        // ->groupBy('movie.id')
        // ->orderBy('id','DESC')->paginate(10);
        $list = Movie::selectRaw('movies.*, SUM(episodes.luotXem) as total_views')
                ->with('category', 'movie_genre', 'country', 'episode')
                ->withCount('episode')
                ->leftJoin('episodes', 'movies.id', '=', 'episodes.movie_id') // Chỉnh sửa tên cột kết nối
                ->groupBy('movies.id')
                ->orderBy('movies.id', 'DESC')
                ->paginate(10);
        $listJson = Movie::with('category','movie_genre','country')->orderBy('id','DESC')->GET();
        $path = public_path()."/jsonFile";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'/movies.json',json_encode($listJson,JSON_UNESCAPED_UNICODE));
        return view('admincp.movie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $listGenre = Genre::all();
        $country = Country::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->GET();
        return view('admincp.movie.form',compact('list','category','genre','country','listGenre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
         $data = $request->all();
         $movie = new Movie();
         $movie->title =$data['title'];
         $movie->description =$data['description'];
         $movie->tags =$data['tags'];
         $movie->name_eng =$data['name_eng'];
         $movie->duration =$data['duration'];
         $movie->sotap =$data['sotap'];
         $movie->resolution = $data['resolution'];
         $movie->phude = $data['phude'];
         $movie->topview = $data['topview'];
         $movie->trailer = $data['trailer'];
         $movie->year = $data['year'];
         $movie->slug =$data['slug'];
         $movie->status = $data['status'];
         $movie->thuocphim =$data['thuocphim'];
         $movie->category_id = $data['category_id'];
         foreach($data['genre'] as $key => $gen){
             $movie->genre_id = $gen[0];
         }
         $movie->country_id = $data['country_id'];
         $movie->phimhot = $data['phimhot'];
         $movie->ngayTao = Carbon::now('Asia/Ho_Chi_Minh');
         $movie->ngayUpdate = Carbon::now('Asia/Ho_Chi_Minh');
        
        //them va xu ly ten anh
        if($request->has('hinhanh')){
            $get_image = $request->file('hinhanh');
            $path = public_path().'/upload/movie';
            if(isset($get_image)){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $movie->image = $new_image;
            }
            $movie->save();
            $movie->movie_genre()->attach($data['genre']);
            $list = Movie::selectRaw('movies.*, SUM(episodes.luotXem) as total_views')
                ->with('category', 'movie_genre', 'country', 'episode')
                ->withCount('episode')
                ->leftJoin('episodes', 'movies.id', '=', 'episodes.movie_id') // Chỉnh sửa tên cột kết nối
                ->groupBy('movies.id')
                ->orderBy('movies.ngayTao', 'DESC')
                ->paginate(10);
            toastr()->success('Thành công','Thêm phim thành công');
            return view('admincp.movie.index',compact('list'));
       
    }else {
        alert("Bạn cần thêm hình ảnh");
    }  
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $listGenre = Genre::all();
        $country = Country::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->GET();
        $movie =Movie::find($id);
        $movieGenre = $movie->movie_genre;
        return view('admincp.movie.form',compact('movie','category','genre','country','listGenre','movieGenre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title =$data['title'];
        $movie->description =$data['description'];
        $movie->tags =$data['tags'];
        $movie->name_eng =$data['name_eng'];
        $movie->resolution = $data['resolution'];
        $movie->duration =$data['duration'];
        $movie->sotap =$data['sotap'];
        $movie->phude = $data['phude'];
        $movie->topview = $data['topview'];
        $movie->year = $data['year'];
        $movie->slug =$data['slug'];
        $movie->trailer = $data['trailer'];
        $movie->status = $data['status'];
        $movie->thuocphim =$data['thuocphim'];
        $movie->category_id = $data['category_id'];
        foreach($data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        $movie->country_id = $data['country_id'];
        $movie->phimhot = $data['phimhot'];
        $movie->ngayUpdate = Carbon::now('Asia/Ho_Chi_Minh');
        //cap nhat va xu ly ten anh
        if ($request->hasFile('hinhanh')) {
            $get_image = $request->file('hinhanh');
            $path = public_path().'/upload/movie/';
            if(!empty($movie->image) && file_exists($path . $movie->image)) {
                unlink($path.$movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
        $list = Movie::selectRaw('movies.*, SUM(episodes.luotXem) as total_views')
                ->with('category', 'movie_genre', 'country', 'episode')
                ->withCount('episode')
                ->leftJoin('episodes', 'movies.id', '=', 'episodes.movie_id') // Chỉnh sửa tên cột kết nối
                ->groupBy('movies.id')
                ->orderBy('movies.ngayUpdate', 'DESC')
                ->paginate(10);
        toastr()->success('Cập nhật','Cập nhật thành công');
        return view('admincp.movie.index',compact('list','movie'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $movie=Movie::find($id);
        //xoa ảnh 
        $path = public_path().'/upload/movie/';
        if(!empty($movie->image) && file_exists($path . $movie->image))
        {
            unlink($path.$movie->image);
        }
        //Xoa the loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        //xoa tap phim
        Episode::whereIn('movie_id',[$movie->id])->delete();
        //Xoa danh gia
        Rating::whereIn('movie_id',[$movie->id])->delete();
         $movie->delete();
         $list = Movie::with('category','movie_genre','country')->withCount('episode')->orderBy('id','DESC')->paginate(10);     
         toastr()->success('Xóa','Xóa  thành công');
         return view('admincp.movie.index',compact('list'));
    }
    public function categoryUpdate(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movieID']);
        $movie->category_id = $data['categoryID'];
        $movie->save();
    }
}
