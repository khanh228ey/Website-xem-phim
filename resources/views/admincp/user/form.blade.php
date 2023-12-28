@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <br>
                <br>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($user))
                        {!! Form::open(['route'=>'user.store','method'=>'POST'])!!}
                    @else
                         {!! Form::open(['route'=>['user.update',$user->id],'method'=>'PUT'])!!}
                    @endif
                 <div class="form-group">
                    {!! Form::label('Họ tên','hoten',[])!!}
                    {!! Form::text('name',isset($user) ? $user->name:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...',])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('Họ tên','hoten',[])!!}
                    {!! Form::text('email',isset($user) ? $user->email:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('role_id','Vai trò',[])!!}
                    {!! Form::select('role_id',$role,isset($user)? $user->role_id:'',['class'=>'form-control'])!!}
                 </div>
                 @if (!isset($user))
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
