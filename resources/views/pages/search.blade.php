@extends('layout');
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span>Kết quả tìm kiếm : <span class="breadcrumb_last" aria-current="page">{{$search}}</span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
            @if(isset($movie))
             <h1 class="section-title"><span>Phim được tìm thấy</span></h1>
             @else 
             <h1 class="section-title"><span>Không tìm thấy phim</span></h1>
             @endif
          </div>
          <div class="halim_box">
            @foreach ($movie as $mv)
             <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{route('phim',$mv->slug)}}" title="{{$mv->title}}">
                      <figure><img class="lazy img-responsive" src="{{asset('upload/movie/'.$mv->image)}}" alt="{{$mv->title}}" title="{{$mv->title}}"></figure>
                      <span class="status"> 
                        @if ($mv->resolution == 0)
                     HD
                 @elseif($mv->resolution == 1)
                     SD
                     @elseif($mv->resolution == 2)
                     HDCAM
                     @elseif($mv->resolution == 4)
                        FullHD
                        @else 
                        Trailer
                 @endif 
                  </span> @if($mv->phude == 1)? <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> @endif 
                      <div class="icon_overlay"></div>
                      <div class="halim-post-title-box">
                         <div class="halim-post-title ">
                            <p class="entry-title">{{$mv->title}}</p>
                            <p class="original_title">{{$mv->name_eng}}</p>
                         </div>
                      </div>
                   </a>
                </div>
             </article>
             @endforeach
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             <ul class='page-numbers'>
               {{$movie->links()}}
             </ul>
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
 @endsection