@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <br>
<br>
<table class="table" id="tablephim" >
</div>
</div>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên phim</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col" >Thời lượng phim</th>
        <th scope="col">Số tập</th>
        <th scope="col">Chất lượng</th>
        <th scope="col">Danh mục</th>
        <th scope="col">Thể loại</th>
        <th scope="col">Quốc gia</th>
        <th scope="col">Lượt Xem</th>
        <th scope="col">Phim hot</th>
        <th scope="col">Top view </th>
        <th scope="col">Manages</th>
        <th scope="col">Thêm tập cho phim</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$mv)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$mv->title}}</td>
        <td><img  src="{{asset('upload/movie/'.$mv->image)}}"  alt="" style="width: 200px; height: 150px;"></td>
        <td >{{$mv->duration}}</td>
        <td >{{$mv->episode_count}}/{{$mv->sotap}} Tập</td>
        <td>
          @if ($mv->resolution == 0)
              HD
          @elseif ($mv->resolution == 1)
              SD
          @elseif ($mv->resolution == 2)
              HDCAM
          @elseif ($mv->resolution == 3)
              SDCAM
              @elseif ($mv->resolution == 4)
                FullHD
          @else
              Trailer
          @endif
      </td>
    <td>{{$mv->category->title}}</td>
        <td>
            @foreach ($mv->movie_genre as $gen)
                <span class="badge badge-dark" style="background: black">{{$gen->title}}</span>
            @endforeach    
        </td>

        <td>{{$mv->country->title}}</td>
        <td>{{$mv->luotxem}}</td>
        <td>
          @if ($mv->phimhot)
              Phim hot
          @else
              Phim khong hot
          @endif
      </td>
      <td>
        @if ($mv->topview == 1)
        Tuần
    @elseif ($mv->topview == 2)
        Tháng
    @elseif ($mv->topview == 3)
        Qúy
    @else
        Không nằm trong top view
    @endif
       </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['movie.destroy',$mv->id],'onsubmit'=>'return confirm("Xóa hay ko")'])!!}
                {!! Form::submit('Xóa',['class'=>'btn btn-danger'])!!}
            {!! Form::close()!!}
            <a href="{{route('movie.edit',$mv->id)}}" class="btn btn-warning">Sửa</a>
        </td>
        <td ><a href="{{route('viewEpisode',[$mv->id])}}" class="btn btn-warning" style="width: 100px">Xem danh sách tập phim</a></td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
{{$list->links()}}
<a href="{{route('movie.create')}}"><button class="btn btn-success">Thêm phim</button></a>
@endsection
