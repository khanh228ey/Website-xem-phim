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
                          <ul class="nav navbar-nav" id="sortable">
                            <li class="active"><a href="{{url('/')}}" target="blank">Trang chủ</a></li>
                            @forEach($category as $key => $cate)
                            <li id="{{$cate->id}}" class="ui-state-default"><a title="{{$cate->title}}" href="{{route('danhmuc',$cate->slug)}}">{{$cate->title}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </nav>
                    </div>
            </div>
       </div>
    </div>
</div>
<script type="text/javascript">
  //   $(function(){
  //     $('#sortable_navbar').sortable({
  //       placeholder:"ui-state-highlight",
  //       update:function(event,ui){
  //         var array_id =[];
  //         $('.category_position li').each(function(){
  //           array_id.push($this(this).attr('id'));
  //         })
  //         $.ajax({
  //           headers: {
  //             'X-CRSF-TOKEN' :$('meta[name="crsf-token"]').attr('content')
  //           },
  //           url:{{route('resorting_navbar')}},
  //           method:"POST",
  //           data:{array_id:array_id},
  //           success:function(data){
  //             alert('Sắp xếp thứ tự menu thành công');
  //           }
  //         })
  //       }
  //     });
  //   })
</script>
@endsection
