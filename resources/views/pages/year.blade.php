@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs">
                        <span>
                           <span><a href="">Phim thuộc năm</a> » 
                           <span class="breadcrumb_last" aria-current="page">{{$year}}</span></span>
                        </span>
                     </div>
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
                     <h1 class="section-title"><span>Năm: {{$year}}</span></h1>
                  </div>
                  <div class="halim_box">
                     @foreach($movie as $key =>$mov)
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$mov->slug)}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}"  title="{{$mov->title}}"></figure>
                              <!-- <span class="status">TẬP </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>  -->
                              <span class="status">
                                    @if($mov->resolution == 0)
                                        HD
                                     @elseif($mov->resolution == 1)
                                       SD
                                    @elseif($mov->resolution == 2)
                                       HDCam
                                      @elseif($mov->resolution == 3)
                                       Cam
                                      @elseif($mov->resolution == 4)
                                        FullHD
                                      @else
                                        Trailer
                                      @endif
                                 </span>
                                 <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                      @if($mov->subtitle == 0)
                                        Phụ đề
                                    @else
                                        Thuyết minh
                                    @endif
                                 </span> 
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
                  <div class="clearfix"></div>
                  <div class="text-center">
         
                     {!! $movie->links("pagination::bootstrap-4") !!} <!-- Phân trang -->
                  
                  </div>
               </section>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Top Views</span>
                        <ul class="halim-popular-tab" role="tablist">
                           <li role="presentation" class="active">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                           </li>
                           <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Week</a>
                           </li>
                           <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                           </li>
                           <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                 <section class="tab-content">
                     <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                           <div class="item post-37176">
                              <a href="chitiet.php" title="">
                                 <div class="item-link">
                                    <img src="" class="lazy post-thumb" alt="" title="" />
                                    <!-- <span class="is_trailer">Trailer</span> -->
                                 </div>
                                 <p class="title"></p>
                              </a>
                              <!-- <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div> -->
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                           </div>

                          
                          
                        </div>
                     </div>
                  </section>
                  <div class="clearfix"></div>
               </div>
            </aside>
         </div>
@endsection