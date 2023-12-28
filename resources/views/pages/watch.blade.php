@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
               <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('danhmuc',$getMovie->category->slug)}}">{{$getMovie->category->title}}</a><span><a href=""></a> » <span class="breadcrumb_last" aria-current="page">{{$getMovie->title}}</span></span> » </span></span>Tập: {{$getEpisode->sotap}}</div>
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
            <style type="text/css">
               .iframe_phim iframe{
                  width: 100% ;
                  height:500px;
               }
            </style>
            <div  class="iframe_phim" style="" >
                <iframe width="560" height="315" src="{{$getEpisode->link_phim}}" title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
               </div>
             <div class="button-watch">
                <ul class="halim-social-plugin col-xs-4 hidden-xs">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                </ul>
                <ul class="col-xs-12 col-md-8">
                   <div id="autonext" class="btn-cs autonext">
                      <i class="icon-autonext-sm"></i>
                      <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                   </div>
                   <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                      Expand 
                   </div>
                   <div id="toggle-light"><i class="hl-adjust"></i>
                      Light Off 
                   </div>
                   <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                   <div class="luotxem"><i class="hl-eye"></i>
                      <span>{{$getEpisode->luotxem}}</span> lượt xem 
                   </div>
                   <div class="luotxem">
                      <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                   </div>
                </ul>
             </div>
             <div class="collapse" id="moretool">
                <ul class="nav nav-pills x-nav-justified">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                   <div class="fb-save" data-uri="" data-size="small"></div>
                </ul>
             </div>
          
             <div class="clearfix"></div>
             <div class="clearfix"></div>
             <div class="title-block">
                <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                      <div class="halim-pulse-ring"></div>
                   </div>
                </a>
                <div class="title-wrapper-xem full">
                   <h1 class="entry-title"><a href="" title="{{$getMovie->title}}" class="tl">{{$getMovie->title}}</a></h1>
                </div>
             </div>
             <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                <article id="post-37976" class="item-content post-37976"></article>
             </div>
             <div class="clearfix"></div>
             <div class="text-center">
                <div id="halim-ajax-list-server"></div>
             </div>
             <div id="halim-list-server">
                <ul class="nav nav-tabs" role="tablist">
                  <div class="section-bar clearfix">
                     <h3 class="section-title"><span>Tập phim</span></h3>
                  </ul>
                <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                      <div class="halim-server">
                         <ul class="halim-list-eps">
                           {{-- hiển thị số tập --}}
                           @foreach($getMovie->episode as $sotap)
                            <a href="{{url('xem-phim/'.$getMovie->slug."/tap-".$sotap->sotap)}}"><li class="halim-episode"><span 
                              class="halim-btn halim-btn-2 {{$tapphim == $sotap->sotap ?'active':''}} halim-info-1-1 box-shadow">{{$sotap->sotap}}</span></li></a>
                           @endforeach
                           </ul>
                        </div>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="htmlwrap clearfix">
                <div id="lightout"></div>
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
    @include('pages.include.sidebar')
   @if(Auth::check())
   <p></p>
   @else 
   @include('pages.include.banner')
   @endif
 </div>
 @endsection