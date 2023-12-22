@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($episode))
                        {!! Form::open(['route'=>'episode.store','method'=>'POST'])!!}
                    @elseif(isset($movie))
                        {!! Form::open(['route'=>'episode.storeEpisode','method'=>'POST'])!!}
                    @else
                         {!! Form::open(['route'=>['episode.update',$episode->id],'method'=>'PUT'])!!}
                    @endif
                 <div class="form-group">
                    @if(isset($episode))
                        {!! Form::label('movie','Tên phim',[])!!}
                        {!! Form::text('phim',$episode->movie->title,['class'=>'form-control' , 'disabled'])!!}
                    @elseif(isset($movie))
                        {!! Form::label('movie', 'Tên phim', []) !!}
                        {!! Form::text('tenphim', $movie->title, ['class' => 'form-control', 'disabled']) !!}
                        {!! Form::hidden('movie_id', $movie->id) !!}
                    @else
                        {!! Form::label('movie','Chọn phim',[])!!}
                        {!! Form::select('movie_id',['0'=>'Chọn phim' ,'Phim mới nhất'=>$listMovie],isset($eposide) ? $eposide->movie_id:'',['class'=>'form-control select-movie'])!!}
                   @endif
                 </div>
                 <div class="form-group">
                    {!! Form::label('linkPhim','Link Phim',[])!!}
                    {!! Form::text('linkPhim',isset($episode) ? $episode->link_phim:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...', 'required'=>'required'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('linkPhim','Tập phim',[])!!}
                    @if(isset($episode))
                    {!! Form::text('tapphim','..'.$episode->sotap,['class'=>'form-control' , 'disabled'])!!}
                    @elseif(isset($movie))
                        <select name="episode" id="show-movie" class="form-control">
                            @for ($i = 1; $i <= $movie->sotap; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor                         
                        </select>
                    @else
                    <select name="episode" id="show-movie" class="form-control">
                        <option value="">Chọn tập phim</option>
                   </select>
                   @endif
                 </div>
                 @if (!isset($episode))
                     {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success'])!!}      
                 @else
                     {!! Form::submit('Cập nhật',['class'=>'btn btn-success'])!!}
                 @endif
                 {!! Form::close('')!!}
                </div>
            </div>
       </div>
    </div>
</div>

@endsection
