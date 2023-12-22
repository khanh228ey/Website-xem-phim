<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Episode::with('movie')->orderBy('movie_id','DESC')->paginate(10);
        return view('admincp.episode.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listMovie = Movie::orderBy('id','DESC')->pluck('title','id','sotap');
        return view('admincp.episode.form',compact('listMovie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data =$request->all();
        $episodeCheck = Episode::where('sotap',$data['episode'])->where('movie_id',$data['movie_id'])->count();
        if($episodeCheck > 0){
            echo '<script type="text/javascript">
            alert("Thông báo: Tập phim này đã được thêm , hãy chọn tập khác");
            window.history.back();
            </script>';
            // Kết thúc xử lý ở đây
                return;
        }else{
        $episode = new Episode();
        $episode->movie_id =$data['movie_id'];
        $episode->link_phim =$data['linkPhim'];
        $episode->sotap = $data['episode'];
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        $list = Episode::with('movie')->orderBy('movie_id','DESC')->paginate(10);
        toastr()->success('Thành công','Thêm danh mục thành công');
        return view('admincp.episode.index',compact('list'));
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
        $episode =Episode::find($id);
        return view('admincp.episode.form',compact('episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data =$request->all();
        $episode =Episode::find($id);
        $episode->link_phim =$data['linkPhim'];
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        $list = Episode::with('movie')->orderBy('movie_id','DESC')->paginate(10);
        toastr()->success('Cập nhật','Cập nhật danh mục thành công');
        return view('admincp.episode.index',compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Episode::find($id)->delete();
        $list = Episode::with('movie')->orderBy('movie_id','DESC')->paginate(10);
        toastr()->success('Xóa','Xóa quốc gia thành công');
        return view('admincp.Episode.index',compact('list'));
    }

    public function selectMovie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option value="">---Chọn tập phim--- </option>';
        for($i=1;$i<=$movie->sotap;$i++){
            $output.='<option value="'.$i.'">' .$i. '</option>';
        }
        echo $output;
    }
    public function viewEpisode($id){
        $movie = Movie::find($id);
        $list = Episode::with('movie')->where('movie_id',$id)->orderBy('movie_id','DESC')->paginate(10);
        return view('admincp.episode.index',compact('list','movie'));
    }
    public function addEpisode($id){
        $movie = Movie::find($id);
        return view('admincp.episode.form',compact('movie'));
    }
   
}
