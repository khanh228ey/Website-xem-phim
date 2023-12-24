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
                    <br>
                    <br>
                    <br>
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                          <ul class="nav navbar-nav category_position" id="sortable_navbar">
                            <li class="active"><a href="{{url('/')}}" target="blank">Trang chủ</a></li>
                            @forEach($category as $key => $cate)
                            <li id="{{$cate->id}}" class="mega ui-state-default"><a title="{{$cate->title}}" href="{{route('danhmuc',$cate->slug)}}">{{$cate->title}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </nav>
                    </div>
            </div>
       </div>
    </div>
</div>
@endsection
