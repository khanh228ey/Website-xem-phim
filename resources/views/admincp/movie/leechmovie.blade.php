@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <br>
<br>
<table class="table">
</div>
</div>
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Tên chính thức</th>
        <th scope="col">Hình ảnh phim</th>
        <th scope="col">Hình ảnh poster</th>
        <th scope="col">Slug</th>
        <th scope="col">ID</th>
        <th scope="col">YEAR</th>
        <th scope="col">Thêm phim</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($resp['items'] as $key => $res)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$res['name']}}</td>
        <td>{{$res['origin_name']}}</td>
        <td><img src="{{$resp['pathImage'].$res['thumb_url']}}" alt="" height="80" width="80"></td>
        <td><img src="{{$resp['pathImage'].$res['thumb_url']}}" alt="" height="80" width="80"></td>
        <td>{{$res['slug']}}</td>
        <td>{{$res['_id']}}</td>
        <td>{{$res['year']}}</td>
        <td>
          <a href="{{route('addMovie',$res['slug'])}}" class="btn btn-warning">Thêm phim</a>
        </td>
       
      @endforeach
    </tbody>
  </table>
</div>
</div>
{{-- {{$list->links()}} --}}
@endsection
