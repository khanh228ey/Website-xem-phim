@extends('layout');
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('danhmuc',$getMovie->category->slug)}}">{{$getMovie->category->title}}</a><span><a href=""></a> » <span class="breadcrumb_last" aria-current="page">{{$getMovie->title}}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring"></div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                      Bookmark
                   </div>
                </div>
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                      <img class="movie-thumb" src="{{asset('upload/movie/'.$getMovie->image)}}" alt="{{$getMovie->title}}">
                       @if($getMovie->resolution != 5 && isset($episode))
                         {{-- xemm phim --}}
                      <div class="bwa-content">
                        <div class="loader"></div>
                        <a href="{{url('xem-phim/'.$getMovie->slug."/tap-".$episodeFirst->sotap)}}" class="bwac-btn">
                        <i class="fa fa-play"></i>
                        </a>
                     </div>
                      @else
                      {{-- xem trailer --}}
                     <div class="bwa-content">
                         <div class="loader"></div>
                         <a href="#trailer" class="bwac-btn">
                         <i class="fa fa-play"></i>
                         </a>
                      </div>
                      @endif
                   </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$getMovie->title}}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{$getMovie->name_eng}}</h2>
                      <ul class="list-info-group">
                         <li class="list-info-group-item"><span>Trạng thái</span> : <span class="quality">
                           @if ($getMovie->resolution == 0)
                           HD
                       @elseif($getMovie->resolution == 1)
                           SD
                           @elseif($getMovie->resolution == 2)
                           HDCAM
                           @elseif($getMovie->resolution == 3)
                           SDCAM
                           @elseif($getMovie->resolution == 4)
                           FullHD
                           @else 
                           Trailer
                       @endif 
                       @if($getMovie->phude == 1)<span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> @endif 
                        @if($getMovie->thuocphim == 2)
                           <li class="list-info-group-item"><span>Loại phim</span> : Phim bộ</li>
                           <li class="list-info-group-item"><span>Thời lượng</span> : {{$getMovie->sotap}} Tập</li>
                           @else
                           <li class="list-info-group-item"><span>Loại phim</span> : Phim Lẻ</li>
                           <li class="list-info-group-item"><span>Thời lượng</span> : {{$getMovie->duration}}</li>
                        @endif
                          
                         <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach ($getMovie->movie_genre as $mvGenre)
                               <a href="{{route('theloai',[$mvGenre->slug])}}" rel="category tag">{{$mvGenre->title}}</a>
                           @endforeach
                        </li>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('quocgia',$getMovie->country->slug)}}" rel="tag">{{$getMovie->country->title}}</a></li>
                         <li class="list-info-group-item"><span>Năm sản xuất</span> : <a class="director" rel="nofollow" href="" title="Cate Shortland">{{$getMovie->year}}</a></li>
                         @if($getMovie->resolution != 5 && isset($episode))
                         <li class="list-info-group-item"><span>Tập phim mới nhất</span>:
                          @foreach ($getEpisode as $episode)
                               <a href="{{url('xem-phim/'.$getMovie->slug."/tap-".$episodeFirst->sotap)}}" rel="category tag">Tập {{$episode->sotap}}</a>
                           @endforeach
                        </li>
                        @else
                        <li class="list-info-group-item"><span>Tập phim mới nhất</span> : <a class="director" rel="nofollow" href="" title="Cate Shortland">Đang cập nhật</a></li>
                        @endif
                        <ul class="list-inline rating"  title="Average Rating">

                           @for($count=1; $count<=5; $count++)
   
                             @php
   
                               if($count<=$rating){ 
                                 $color = 'color:#ffcc00;'; //mau vang
                               }
                               else {
                                 $color = 'color:#ccc;'; //mau xam
                               }
                             
                             @endphp
                           
                             <li title="star_rating" 
   
                             id="{{$getMovie->id}}-{{$count}}" 
                             
                             data-index="{{$count}}"  
                             data-movie_id="{{$getMovie->id}}" 
   
                             data-rating="{{$rating}}" 
                             class="rating" 
                             style="cursor:pointer; {{$color}} 
   
                             font-size:30px;">&#9733;</li>
                           @endfor
                        </ul>
                        <span class="total_rating">Đánh giá : {{$rating}}/{{$count_total}}lượt</span>
                      </ul>
 
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d" id="trailer">Nội dung phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                     <article class="item-content" id="post-38424" >
                        {{$getMovie->description}}
                     </article>
               </div>
             </div>
             {{--trailer --}}
           @if (isset($getMovie->trailer))
           <div class="section-bar clearfix" >
            <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
         </div>
         <div class="entry-content htmlwrap clearfix">
           <div class="video-item halim-entry-box ">
                 <article class="item-content" >
                  <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$getMovie->trailer}}" title="Trailer {{$getMovie->title}}" frameborder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                   allowfullscreen></iframe>
                 </article>
           </div>
         </div>
           @endif
           {{-- tags phim --}}
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                      Phim <a href="">{{$getMovie->title}}</a> - 
                      @foreach ($getMovie->movie_genre as $mvGenre)
                               <a href="" {{route('theloai',[$mvGenre->slug])}}>{{$mvGenre->title}}</a>-
                           @endforeach
                       <a href="{{route('quocgia',$getMovie->country->slug)}}">{{$getMovie->country->title}}: </a>
                      <h5>Từ Khoá Tìm Kiếm:</h5>
                      <ul>
                        @if($getMovie->tags!=NULL)
                        @php
                           $tags = array();
                           $tags = explode(',',$getMovie->tags)   
                        @endphp
                        @foreach($tags as $item)
                         <li><a href="">{{$item}}</a></li>
                         @endforeach
                         @else
                         <li>Chưa có từ khóa</li>
                        @endif
                      </ul>
                   </article>
                </div>
             </div>
          </div>
          {{--Comment facebook--}}
          <div class="section-bar clearfix"  >
            <h2 class="section-title"><span style="color:#ffed4d ,">Bình luận</span></h2>
         </div>
         <div class="entry-content htmlwrap clearfix">
           <div class="" style="background-color: white">
            @php
                $urlComment = Request::url(); 
            @endphp
                 <article class="item-content" >
                  <div  class="fb-comments" data-href="{{$urlComment}}" 
                        data-width="100%" data-numposts="20" ></div> 
                 </article>
           </div>
         </div>
       </section>
       {{-- phim liên quan --}}
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>PHIM CÓ LIÊN QUAN</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach ($movieRelated as $movie)
                   <article class="thumb grid-item post-38498">
                   <div class="halim-item">
                      <a class="halim-thumb" href="{{route('phim',$movie->slug)}}" title="{{$movie->title}}">
                         <figure><img class="lazy img-responsive" src="{{asset('upload/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                         <span class="status"> @if($movie->resolution == 0) HD 
                           @elseif ($movie->resolution == 1) SD
                           @elseif ($movie->resolution == 2) HDCAM
                           @elseif ($movie->resolution == 3) SDCAM
                           @else
                             FULLHD
                        @endif</span>@if($movie->phude == 1)<span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> @endif 
                         <div class="icon_overlay"></div>
                         <div class="halim-post-title-box">
                            <div class="halim-post-title ">
                               <p class="entry-title">{{$movie->title}}</p>
                               <p class="original_title">{{$movie->name_eng}}</p>
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
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
             </script>
          </div>
       </section>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
 </div>
 @endsection