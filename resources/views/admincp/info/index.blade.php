@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Danh sách thể loại') }}</div>
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Logo</th>
        <th scope="col">Description</th>
        <th scope="col">Cập Nhật</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$info)
      <tr>
        <th scope="row">{{$info->id}}</th>
        <td>{{$info->title}}</td>
        <td><img  src="{{asset('upload/logo/'.$info->logo)}}"  alt="" style="width: 200px; height: 150px;"></td>
        <td>{{$info->description}}</td>
        <td>
            {!! Form::close()!!}
            <a href="{{route('info.edit',$info->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

@endsection
