<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Genre::all();
        return view('admincp.genre.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admincp.genre.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data =$request->all();
        $genre = new genre();
        $genre->title =$data['title'];
        $genre->description =$data['description'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];
        $genre->save();
        $list = genre::all();
        toastr()->success('Thành công','Thêm  thành công');
        return view('admincp.genre.index',compact('list'));
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
        $genre =genre::find($id);
        $list = genre::all();
        return view('admincp.genre.form',compact('list','genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $genre = genre::find($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];
        $genre->save();
        $list = genre::all();
        toastr()->success('Cập nhật','Cập nhật  thành công');
        return view('admincp.genre.index',compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $list = genre::all();
        $isUsedInMovies = Movie_Genre::where('genre_id', $id)->exists();
        $isUsedInMovies1 = Movie::where('genre_id', $id)->exists();

        if ($isUsedInMovies ) {
        toastr()->error('Không thể xóa', 'Thể loại đang được sử dụng trong bảng Movies');
        return view('admincp.genre.index',compact('list'));
        
    }
        if ($isUsedInMovies1) {
            toastr()->error('Không thể xóa', 'Thể loại đang được sử dụng trong bảng Movies');
            return view('admincp.genre.index',compact('list'));
        }else{
        genre::find($id)->delete();
        toastr()->success('Xóa','Xóa  thành công');
        return view('admincp.genre.index',compact('list'));
        }
    }
}
