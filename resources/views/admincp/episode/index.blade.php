@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <br>
              <br>
                
<table class="table" id="tablephim">
</div>
</div>
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tập</th>
        <th scope="col">Lượt xem</th>
        <th scope="col">Link phim</th>
        <th scope="col">Manages</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$episode)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$episode->movie->title}}</td>
        <td><img  src="{{asset('upload/movie/'.$episode->movie->image)}}"  alt="" style="width: 200px; height: 150px;"></td>
        <td>Tập: {{$episode->sotap}}</td>
        <td>{{$episode->luotxem}}</td>        
        <td> <iframe width="560" height="315" src="{{$episode->link_phim}}" title="YouTube video player" frameborder="0" 
          allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></td> 
        <td>
          {!! Form::open(['method' => 'DELETE', 'route' => ['episode.destroy', $episode->id], 'onsubmit' => 'return confirm("Xóa hay không?")']) !!}
          {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
            <a href="{{route('episode.edit',$episode->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{$list->links()}}
@if(isset($movie))
<a href="{{route('addEpisode',$movie->id)}}"><button class="btn btn-success">Thêm tập cho phim</button></a>
@else
<a href="{{route('episode.create')}}"><button class="btn btn-success">Thêm tập cho phim</button></a>
@endif
</div>

@endsection
