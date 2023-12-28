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
        <th scope="col">STT</th>
        <th scope="col">Họ tên</th>
        <th scope="col">Email</th>
        <th scope="col">Vai trò</th>
        <th scope="col">Cập Nhật</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($getUser as $key=>$user)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->role}}</td>
        <td>
            {!! Form::close()!!}
            <a href="{{route('user.edit',$user->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

@endsection
