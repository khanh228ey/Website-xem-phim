<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $list = Country::all();
        return view('admincp.country.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admincp.country.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data =$request->all();
        $country = new Country();
        $country->title =$data['title'];
        $country->description =$data['description'];
        $country->slug = $data['slug'];
        $country->status = $data['status'];
        $country->save();
        $list = Country::all();
        toastr()->success('Thành công','Thêm quốc gia thành công');
        return view('admincp.country.index',compact('list'));
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
        $country =Country::find($id);
        $list = Country::all();
        return view('admincp.country.form',compact('list','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $country = country::find($id);
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->slug = $data['slug'];
        $country->status = $data['status'];
        $country->save();
        $list = country::all();
        toastr()->success('Cập nhật','Cập nhật thành công');
        return view('admincp.country.index',compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Country::find($id)->delete();
        $list = Country::all();
        toastr()->success('Xóa','Xóa  thành công');
        return view('admincp.country.index',compact('list'));
    }
}
