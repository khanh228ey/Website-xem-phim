@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Danh sách danh mục') }}</div>
                
<table class="table" id="tablephim">
</div>
</div>
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tập</th>
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
        <td>{!!$episode->link_phim!!}</td> 
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