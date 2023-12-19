<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

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
        return view('admincp.genre.form');
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
        genre::find($id)->delete();
        $list = genre::all();
        toastr()->success('Xóa','Xóa  thành công');
        return view('admincp.genre.index',compact('list'));
    }
}
