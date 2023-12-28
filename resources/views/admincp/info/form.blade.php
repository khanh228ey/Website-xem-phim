@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __(' Chỉnh sửa thông tin website ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($info))
                        {!! Form::open(['route'=>'info.store','method'=>'POST'])!!}
                    @else
                         {!! Form::open(['route'=>['info.update',$info->id],'method'=>'PUT'])!!}
                    @endif
                 <div class="form-group">
                    {!! Form::label('title','Title',[])!!}
                    {!! Form::text('title',isset($info) ? $info->title:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'slug','onkeyup'=>'ChangeToSlug()'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('hinhanh','Hình ảnh',[])!!}
                    {!! Form::file('hinhanh',['class'=>'form-control'] )!!}
                    @if (isset($info))
                        <img width="200px" src="{{asset('upload/logo/'.$info->logo)}}" alt="">
                    @endif
                 </div>
                 <div class="form-group">
                    {!! Form::label('description','Description',[])!!}
                    {!! Form::textarea('description',isset($info) ? $info->description:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào mô tả...','id'=>'description'])!!}
                 </div>
                 @if (!isset($info))
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
