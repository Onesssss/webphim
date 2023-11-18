@extends('layout')
@section('content')
      <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category',$movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
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
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                              @if($movie->resolution != 5)
                              <div class="bwa-content">
                                 <div class="loade"></div>
                                 <a href="{{route('watch',[$movie->slug])}}" class="bwac-btn">
                                 <i class="fa fa-play"></i>
                                 </a>
                              </div>
                              @endif
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">  
                                    @if($movie->resolution == 0)
                                        HD
                                     @elseif($movie->resolution == 1)
                                       SD
                                    @elseif($movie->resolution == 2)
                                       HDCam
                                      @elseif($movie->resolution == 3)
                                       Cam
                                      @elseif($movie->resolution == 4)
                                        FullHD
                                      @else
                                        Trailer
                                      @endif</span>
                                    @if($movie->resolution != 5)
                                    <span class="episode">
                                     @if($movie->subtitle == 0)
                                        Phụ đề
                                    @else
                                        Thuyết minh
                                    @endif
                                    </span>
                                    @endif
                                 </li>
                                 <li class="list-info-group-item"><span>Thời lượng</span> :{{$movie->thoiluongphim}} </li>
                                 <li class="list-info-group-item"><span>Số tập</span> :{{$movie->episode}} </li>

                                 <li class="list-info-group-item"><span>Thể loại</span> :
                                     @foreach($movie->movie_genre as $gen)
                                          <a href="{{route('genre',$gen->slug)}}" >{{$gen->title}}</a>
                                     @endforeach
                                    <!-- <a href="{{route('genre',$movie->genre->slug)}}" >{{$movie->genre->title}}</a> -->
                                 </li>
                                 <li class="list-info-group-item"><span>Danh mục phim</span>:<a href="{{route('category',$movie->category->slug)}}" >{{$movie->category->title}}</a></li>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a></li>
                              </ul>
                              <div class="movie-trailer hidden"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="halim_trailer"></div>
                     <div class="clearfix"></div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              Phim <a href="{{route('category',$movie->category->slug)}}">{{$movie->title}}</a> {{$movie->country->title}} :
                              <p>{{$movie->title}} &#8211; {{$movie->description}}</p>
                      
                           </article>
                        </div>
                     </div>
                        <!-- trailer phim -->
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                             <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                           </article>
                        </div>
                     </div>

                  </div>
               </section>
                    <!-- comment fb -->
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        @php
                           $current_url = Request::url();

                        @endphp
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                            <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="5"></div>
                           </article>
                        </div>
                     </div>

                  </div>
               </section>

               <section class="related-movies">
                  <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                     </div>
                     <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">

                      @foreach($movie_lienquan as $key => $mov)
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}" alt="{{$mov->title}}" title="{{$mov->title}}"></figure>
                                 <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$mov->title}}</p>

                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                          @endforeach

                       
                     </div>
                     <script>
                        jQuery(document).ready(function($) {				
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                     </script>
                  </div>
               </section>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
         </div>
@endsection('content')