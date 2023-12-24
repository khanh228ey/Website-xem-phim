@extends('layout');
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <div id="#halim_related_movies-2" class="wrap-slider">
      <div class="section-bar clearfix">
         <h3 class="section-title"><span>PHIM HOT HÀNG THÁNG</span></h3>
      </div>
      <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
         @foreach ($hotMovie as $hot)
         <article class="thumb grid-item post-38498">
            <div class="halim-item">
               <a class="halim-thumb" href="{{route('phim',$hot->slug)}}" title="{{$hot->title}}">
                  @php
            $imageCheck = substr($hot->image,0,5);
               @endphp
         @if ($imageCheck == "https")
         <figure><img class="lazy img-responsive" src="{{$hot->image}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
        @else
        <figure><img class="lazy img-responsive" src="{{asset('upload/movie/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
        @endif
                  
                  <span class="status">@if ($hot->resolution == 0)
                     HD
                 @elseif($hot->resolution == 1)
                     SD
                     @elseif($hot->resolution == 2)
                     HDCAM
                     @elseif($hot->resolution == 4)
                        FullHD
                        @else 
                        <i>Trailer</i>
                 @endif 
                  </span> @if($hot->phude == 1)? <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> @endif 
                  <div class="icon_overlay"></div>
                  <div class="halim-post-title-box">
                     <div class="halim-post-title ">
                        <p class="entry-title">{{$hot->title}}</p>
                        <p class="original_title">{{$hot->name_eng}}</p>
                     </div>
                  </div>
               </a>
            </div>
         </article>
         @endforeach
      </div>
      <script>
         $(document).ready(function($) {				
         var owl = $('#halim_related_movies-2');
         owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 5}}})});
      </script>
   </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
      @foreach($categoryHome as $key => $cate_home)
       <section id="halim-advanced-widget-2">
          <div class="section-heading">
            <span class="h-text">{{$cate_home->description}}</span>
             <a href="{{route('danhmuc',$cate_home->slug)}}" title="{{$cate_home->title}}">
               <style type="text/css">
                     .xemthem{
                        position: absolute;
                        right: 0;
                        font-weight: 400;
                        line-height: 21px;
                        padding: 9px 25px 9px 10px;
                        color: white;
                     }
               </style>
               <span class="xemthem">Xem thêm &#8250;</span>
             </a>
          </div>
          <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
            @foreach ($cate_home->movie as $item)
                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{route('phim',$item->slug)}}">
                      <figure><img class="lazy img-responsive" src="{{asset('upload/movie/'.$item->image)}}" alt="{{$item->title}}" title="{{$item->title}}"></figure>
                      <span class="status">@if ($item->resolution == 0)
                        HD
                    @elseif($item->resolution == 1)
                        SD
                        @elseif($item->resolution == 2)
                        HDCAM
                        @elseif($item->resolution == 3)
                        SDCAM
                        @elseif($item->resolution == 4)
                        FullHD
                        @else 
                        Trailer
                    @endif </span>@if($item->phude ==1)? <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> @endif 
                      <div class="icon_overlay"></div>
                      <div class="halim-post-title-box">
                         <div class="halim-post-title ">
                            <p class="entry-title">{{$item->title}}</p>
                            <p class="original_title">{{$item->name_eng}}</p>
                         </div>
                      </div>
                   </a>
                </div>
             </article>   
            @endforeach

          </div>
       </section>
       <div class="clearfix"></div>
       @endforeach
    </main>
  @include('pages.include.sidebar')
  {{-- @include('pages.include.banner') --}}
 </div>
</div>
@endsection