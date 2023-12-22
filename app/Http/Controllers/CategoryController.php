<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Category::orderBy('id','ASC')->GET();
        return view('admincp.category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admincp.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        //

        $data =$request->all();
        $category = new Category();
        $category->title =$data['title'];
        $category->slug =$data['slug'];
        $category->description =$data['description'];
        $category->status = $data['status'];
        $category->save();
        $list = Category::all();
        toastr()->success('Thành công','Thêm danh mục thành công');
        return view('admincp.category.index',compact('list'));
        
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
        $category =Category::find($id);
        $list = Category::all();
        return view('admincp.category.form',compact('list','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
        $list = Category::all();
        toastr()->success('Cập nhật','Cập nhật danh mục thành công');
        return view('admincp.category.index',compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Category::find($id)->delete();
        $list = Category::all();
        toastr()->success('Xóa','Xoá danh mục thành công');
        return view('admincp.category.index',compact('list'));
    }
}
