<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Info::get();
        return view('admincp.info.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $info =Info::find($id);
        
        return view('admincp.info.form',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $info = info::find($id);
        $info->title = $data['title'];
        $info->description = $data['description'];
        //them va xu ly hinh anh
        if ($request->hasFile('hinhanh')) {
            $get_image = $request->file('hinhanh');
            $path = public_path().'/upload/info/';
            if(!empty($info->image) && file_exists($path . $info->image)) {
                unlink($path.$info->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $info->image = $new_image;
        }
        $info->save();
        $list = info::all();
        toastr()->success('Cập nhật','Cập nhật  thành công');
        return view('admincp.info.index',compact('list'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
