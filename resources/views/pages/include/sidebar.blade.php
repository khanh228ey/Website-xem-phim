
 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
   <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
      <div class="section-bar clearfix">
         <div class="section-title">
            <span>Top Views</span>
         </div>
      </div>
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link filter-siderbar" id="pills-home-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-tuan" aria-selected="true">Tuần</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-siderbar" id="pills-profile-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-thang" aria-selected="false">Tháng</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-siderbar" id="pills-contact-tab" data-toggle="pill" href="#quy" role="tab" aria-controls="pills-quy" aria-selected="false">Qúy</a>
         </li>
       </ul>
      <div class="tab-content" id="pills-tabContent">

         <div class="tab-pane fade active" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               @foreach ($getViewTuan as $viewTuan)
               <div class="item post-37176">
                  <a href="{{route('phim',$viewTuan->slug)}}" title="{{$viewTuan->title}}">
                     <div class="item-link">
                        @php
                        $imageCheck = substr($viewTuan->image,0,5);
                           @endphp
                     @if ($imageCheck == "https")
                     <img src="{{$viewTuan->image}}" class="lazy post-thumb" alt="" title="{{$viewTuan->title}}" />
                    @else
                    <img src="{{asset('upload/movie/'.$viewTuan->image)}}" class="lazy post-thumb" alt="" title="{{$viewTuan->title}}" />
                    @endif
                        
                        <span class="is_trailer">Trailer</span>
                     </div>
                     <p class="title">{{$viewTuan->title}}</p>
                  </a>
                  <div class="viewsCount" style="color: #9d9d9d;">{{$viewTuan->luotquantam}} Lượt quan tâm</div>
                  <div class="viewsCount" style="color: #9d9d9d;">Năm: {{$viewTuan->year}} </div>
                  <div style="float: left;">
                        <ul class="list-inline rating" title="Averange Rating">
                           @for($count=1; $count<=5; $count++)
                              <li title="star_rating" style = "font-size:20;color:#ffcc00;padding:0" >
                                 &#9733;
                              </li>
                           @endfor

                        </ul>
                     <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                     <span style="width: 0%"></span>
                     </span>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

         <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               @foreach ($getViewThang as $viewThang)
               <div class="item post-37176">
                  <a href="{{route('phim',$viewThang->slug)}}" title="{{$viewThang->title}}">
                     <div class="item-link">
                        @php
                        $imageCheck = substr($viewThang->image,0,5);
                           @endphp
                     @if ($imageCheck == "https")
                     <img src="{{$viewThang->image}}" class="lazy post-thumb" alt="" title="{{$viewThang->title}}" />
                    @else
                    <img src="{{asset('upload/movie/'.$viewThang->image)}}" class="lazy post-thumb" alt="" title="{{$viewThang->title}}" />
                    @endif
                        <span class="is_trailer">Trailer</span>
                     </div>
                     <p class="title">{{$viewThang->title}}</p>
                  </a>
                  <div class="viewsCount" style="color: #9d9d9d;">{{$viewThang->luotquantam}} Lượt quan tâm</div>
                  <div class="viewsCount" style="color: #9d9d9d;">Năm: {{$viewThang->year}} </div>
                  <div style="float: left;">
                     <ul class="list-inline rating" title="Averange Rating">
                        @for($count=1; $count<=5; $count++)
                           <li title="star_rating" style = "font-size:20;color:#ffcc00;padding:0" >
                              &#9733;
                           </li>
                        @endfor

                     </ul>
                     <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                     <span style="width: 0%"></span>
                     </span>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

         <div class="tab-pane fade" id="quy" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               @foreach ($getViewQuy as $viewQuy)
               <div class="item post-37176">
                  <a href="{{route('phim',$viewQuy->slug)}}" title="{{$viewQuy->title}}">
                     <div class="item-link">
                        @php
                        $imageCheck = substr($viewQuy->image,0,5);
                           @endphp
                     @if ($imageCheck == "https")
                     <img src="{{$viewQuy->image}}" class="lazy post-thumb" alt="" title="{{$viewQuy->title}}" />
                    @else
                    <img src="{{asset('upload/movie/'.$viewQuy->image)}}" class="lazy post-thumb" alt="" title="{{$viewQuy->title}}" />
                    @endif
                       
                        <span class="is_trailer">Trailer</span>
                     </div>
                     <p class="title">{{$viewQuy->title}}</p>
                  </a>
                  <div class="viewsCount" style="color: #9d9d9d;">{{$viewQuy->luotquantam}} Lượt quan tâm</div>
                  <div class="viewsCount" style="color: #9d9d9d;">Năm: {{$viewQuy->year}} </div>
                  <div style="float: left;">
                     <ul class="list-inline rating" title="Averange Rating">
                        @for($count=1; $count<=5; $count++)
                           <li title="star_rating" style = "font-size:20;color:#ffcc00;padding:0" >
                              &#9733;
                           </li>
                        @endfor

                     </ul>
                     <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                     <span style="width: 0%"></span>
                     </span>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
       </div>
    
      <div class="clearfix"></div>
   </div>
</aside>