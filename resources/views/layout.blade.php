<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      

      <link rel="shortcut icon" href="" type="image/x-icon" />
      <meta name="csrf-token" content="{{csrf_token() }}" />
      <meta name='robots' content='indexfollow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <title>{{$getInfoWeb->title}}</title>
      <meta name="description" content="{{$getInfoWeb->description}}" />
      <link rel="canonical" href="">
      <link rel="next" href="" />
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:title" content="" />
      <meta property="og:url" content="{{Request::url()}}" />
      <meta property="og:site_name" content="{{$metaTitle}}" />
      <meta property="og:image" content="{{$metaDescription}}" />
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     
      <link rel='dns-prefetch' href='//s.w.org' />
      <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{asset('css/style.min.css?ver=5.7.2')}}' media='all' />
      <script type='text/javascript' src='{{asset('js/jquery.min.js?ver=5.7.2')}}' id='halim-jquery-js'></script>
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
      </style>
      <style>#header .site-title {background: url(https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png) no-repeat top left;background-size: contain;text-indent: -9999px;}</style>
   </head>
   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <p class=""><a class="logo" href="" title="{{$getInfoWeb->title}}">
                        <img src="{{asset('upload/logo/'.$getInfoWeb->logo)}}"   alt="" width="100" height="85">
                  </a></p>
                  </a>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12" >
                        <style type="text/css">
                              ul#result {
                        position : absolute;
                        z-index: 9999;
                        background : #1b2d3c;
                        width:94%;
                        padding: 10px;
                        margin: 1px;
                     }
                        </style>
                        <form id="search-form-pc" name="halimForm" role="search" action="{{route('timKiem')}}" method="GET">
                           <div class="form-group form-timkiem">
                              <div class="input-group col-xs-12">
                                 <input id="search" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" >
                                 <i class="animate-spin hl-spin4 hidden" ></i>
                              </div>
                           </div>
                        </form>
                        <ul class="list-group" id="result" style="display: none;"><li>Kết quả tìm kiếm</li></ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 hidden-xs">
                  @if(Auth::check())
                     <li class="mega dropdown">
                     <a  id="get-bookmark" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{Auth::user()->name }}<span class="caret"></span></a>
                     {{-- <a href="{{route('dangnhap')}}"><div id="get-bookmark" class=""><span>Đăng nhập</span></div></a> --}}
                     <ul class="dropdown-menu">
                        {!! Form::open(['route'=>'logout','method'=>'POST'])!!}
                        {!! Form::submit('Logout',['class'=>''])!!}
                        {!! Form::close('')!!}
                        @if(Auth::user()->role_id != 1)
                        <a href="{{route('viewAdmin')}}">Trang quản trị</a>
                        @endif
                    </ul>
                  </li>
                  @else
                  <a href="{{route('login')}}"><div id="get-bookmark" class=""><span>Đăng nhập</span></div></a>
                  @endif
                  <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepages')}}">Trang Chủ</a></li>
                        @foreach ($categoryNav as $key => $cate)
                        <li class="mega"><a title="{{$cate->title}}" href="{{route('danhmuc',$cate->slug)}}">{{$cate->title}}</a></li>
                        <li class="mega dropdown">
                           <ul role="menu" class=" dropdown-menu">
                           </ul>
                        </li>
                        @endforeach
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($genre as $key => $gen)
                              <li><a title="{{$gen->title}}" href="{{route('theloai',$gen->slug)}}">{{$gen->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach ($country as $key => $ct)
                              <li><a title="{{$ct->title}}" href="{{route('quocgia',$ct->slug)}}">{{$ct->title}}</a></li>
                              @endforeach
                           </ul>
                        </li> 
                     </ul>
                  </div>
                  <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul>
               </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div>
         </div>
      </div>
      </div>
      
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
          @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-4">
                  <div class="footer-logo">
                     <img class="img-responsive" src="{{asset('upload/logo/'.$getInfoWeb->logo)}}"  alt="" style="width: 200px; height: 150px;" alt="Phim hay 2021- Xem phim hay nhất" />
                  </div>
                  Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[dh52005894@student.stu.edu.vn]</a>
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>
      <script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
      <script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>
     <script type="text/javascript">
         //popup quảng cáo
         // $(window).on('load',function(){
         //    $('#exampleModalCenter').modal('show');
         // });
//          $(document).ready(function () {
//     function showModal() {
//         $('#exampleModalCenter').modal('show');
//     }

//     setTimeout(function () {
//         showModal();
//     }, 5000); // Hiển thị modal sau mỗi 5 giây
// });

$(document).ready(function () {
    function showModal() {
        $('#exampleModalCenter').modal('show');
    }

    // Sử dụng setInterval để hiển thị modal sau mỗi 5 giây
    setInterval(function () {
        showModal();
    }, 5000);
});

         
         //thanh top views
         $(document).ready(function(){
           var tuanTab = $('#pills-home-tab');

         // Kích hoạt tab 'Tuần'
         tuanTab.tab('show');
         })
     </script>
      <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>
      <script type="text/javascript">
      //script tìm kiếm phim ở file json
            $(document).ready(function(){
                $('#search').keyup(function(){
                   $('#result').html('');
                   var search = $('#search').val();
                    if(search !=''){
                     $('#result').css('display','inherit');
                      var expression = new RegExp(search,"i");
                      $.getJSON('/jsonFile/movies.json',function(data){
                        $.each(data,function(key,value){
                           if(value.title.search(expression)!= -1){
                                 $('#result').append('<li style="cursor:pointer; display: flex;  align-items: center;" class="list-group-item link-class"><img src="upload/movie/'+value.image+'" width="40" height ="40"  margin-right: 10px; />'+value.title+'</li>');
                           }
                        });
                      })
                    }else{
                     $('#result').css('display','none');
                    }
                  });
                  $('#result').on('click', 'li' ,function(){
                    var click_text = $(this).text().split("|");
                   $("#search").val($.trim(click_text[0]));
                    $("#result").html('');
                    $("#result").css('display','none');
                  });
               })
            </script>
            
            
      <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}
      </style>
      <style>
         #overlay_pc {
         position: fixed;
         display: none;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.7);
         z-index: 99999;
         cursor: pointer;
         }
         #overlay_pc .overlay_pc_content {
         position: relative;
         height: 100%;
         }
         .overlay_pc_block {
         display: inline-block;
         position: relative;
         }
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 600px;
         height: auto;

         position: relative;
         left: 50%;
         top: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         }
         #overlay_pc .overlay_pc_content .cls_ov {
         color: #fff;
         text-align: center;
         cursor: pointer;
         position: absolute;
         top: 5px;
         right: 5px;
         z-index: 999999;
         font-size: 14px;
         padding: 4px 10px;
         border: 1px solid #aeaeae;
         background-color: rgba(0, 0, 0, 0.7);
         }
         #overlay_pc img {
         position: relative;
         z-index: 999;
         }
         @media only screen and (max-width: 768px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 400px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
         @media only screen and (max-width: 400px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 310px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
        
         }
      </style>
     
      <style>
         .float-ck { position: fixed; bottom: 0px; z-index: 9}
         * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
         #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
         #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
         span.bannermobi2 img {height: 70px;width: 300px;}
         #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
      </style>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" 
               src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="l9kOFITY">
      </script>
      {{-- Đoạn script đánh giá phim :  --}}
      <script type="text/javascript">
      
                    
         function remove_background(movie_id)
          {
           for(var count = 1; count <= 5; count++)
           {
            $('#'+movie_id+'-'+count).css('color', '#ccc');
           }
         }

         //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function(){
           var index = $(this).data("index");
           var movie_id = $(this).data('movie_id');
           remove_background(movie_id);
           for(var count = 1; count<=index; count++)
           {
            $('#'+movie_id+'-'+count).css('color', '#ffcc00');
           }
         });
        //nhả chuột ko đánh giá
        $(document).on('mouseleave', '.rating', function(){
           var index = $(this).data("index");
           var movie_id = $(this).data('movie_id');
           var rating = $(this).data("rating");
           remove_background(movie_id);
           //alert(rating);
           for(var count = 1; count<=rating; count++)
           {
            $('#'+movie_id+'-'+count).css('color', '#ffcc00');
           }
          });

         //click đánh giá sao
         $(document).on('click', '.rating', function(){
            
               var index = $(this).data("index");
               var movie_id = $(this).data('movie_id');
           
               $.ajax({
                url:"{{route('add-rating')}}",
                method:"POST",
                data:{index:index, movie_id:movie_id},
                  headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success:function(data)
                {
                 if(data == 'done')
                 {
                  
                  alert("Bạn đã đánh giá "+index +" trên 5");
                  location.reload();
                  
                 }else if(data =='exist'){
                   alert("Bạn đã đánh giá phim này rồi,cảm ơn bạn nhé");
                 }
                 else
                 {
                  alert("Lỗi đánh giá");
                 }
                 
                }
               });
               
         });

    
     </script>
   </body>
</html>