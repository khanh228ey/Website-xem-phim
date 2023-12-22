@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <br>
<br>
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Slug</th>
        <th scope="col">Active/Inactive</th>
        <th scope="col">Manages</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$cate)
      <tr>
        <th scope="row">{{$cate->id}}</th>
        <td>{{$cate->title}}</td>
        <td>{{$cate->description}}</td>
        <td>{{$cate->slug}}</td>
        <td>
            @if ($cate->status)
                Hiển thị
            @else
                Không hiển thị
            @endif
        </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['category.destroy',$cate->id],'onsubmit'=>'return confirm("Xóa hay ko")'])!!}
                {!! Form::submit('Xóa',['class'=>'btn btn-danger'])!!}
            {!! Form::close()!!}
            <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
    <a href="{{route('category.create')}}"><button class="btn btn-success">Thêm danh mục</button></a>
</div>
</div>

@endsection
