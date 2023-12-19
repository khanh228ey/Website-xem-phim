@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Danh sách quốc gia') }}</div>
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
        @foreach ($list as $key=>$ct)
      <tr>
        <th scope="row">{{$ct->id}}</th>
        <td>{{$ct->title}}</td>
        <td>{{$ct->description}}</td>
        <td>{{$ct->slug}}</td>
        <td>
            @if ($ct->status)
                Hiển thị
            @else
                Không hiển thị
            @endif
        </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['country.destroy',$ct->id],'onsubmit'=>'return confirm("Xóa hay ko")'])!!}
                {!! Form::submit('Xóa',['class'=>'btn btn-danger'])!!}
            {!! Form::close()!!}
            <a href="{{route('country.edit',$ct->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
    <a href="{{route('country.create')}}"><button class="btn btn-success">Thêm quốc gia</button></a>
</div>
</div>

@endsection
