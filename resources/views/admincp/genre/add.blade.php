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
                        {!! Form::open(['route'=>'country.store','method'=>'POST'])!!}
                 <div class="form-group">
                    {!! Form::label('title','Title',[])!!}
                    {!! Form::text('title','',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'slug','onkeyup'=>'ChangeToSlug()'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('slug','Slug',[])!!}
                    {!! Form::text('slug','',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'convert_slug'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('description','Description',[])!!}
                    {!! Form::textarea('description','',['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào mô tả...','id'=>'description'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('ative','Active',[])!!}
                    {!! Form::select('status',['1'=>'Hiển thị','0'=>'Không'],'',['class'=>'form-control'])!!}
                 </div>
                     {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success'])!!}
                 {!! Form::close('')!!}
                </div>
            </div>
       </div>
    </div>
</div>
@endsection
