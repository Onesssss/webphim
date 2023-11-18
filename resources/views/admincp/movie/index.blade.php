@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <style>
                    .center-button {
                        text-align: center;
                    }
                </style>

                <div class="center-button">
                    <a href="{{ route('movie.create') }}" class="btn btn-primary">Them phim</a>
                </div>
            </div>
                <table class="table" id="tablephim">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên Phim</th>
                      <th scope="col">Thời lượng phim</th>
                      <th scope="col">Hình ảnh</th>
                      <th scope="col">Mô tả</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Danh mục</th>
                      <th scope="col">Thể loại</th>
                      <th scope="col">Quốc gia</th> 
                      <th scope="col">Phim Hot</th>
                      <th scope="col">Định Dạng</th>  
                      <th scope="col">Phụ Đề</th> 
                      <th scope="col">Ngày tạo</th>                                                                                  
                      <th scope="col">Ngày cập nhật</th>
                      <th scope="col">Số tập</th>  
                      <th scope="col">Năm phim</th> 
                                                                                                                                                                                                                                                                                                                                            
                      <th scope="col">Quản lý</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $key => $cates )
                    <tr>
                      <th scope="row">{{($key+1)}}</th>
                      <td>{{($cates->title)}}</td>
                      <td>{{($cates->thoiluongphim)}}</td>      
                      <td><img width="60%" src="{{asset('uploads/movie/'.$cates->image)}}"></td>
                      <td>{{($cates->description)}}</td>
                      <td>{{($cates->slug)}}</td>
                      <td>
                          @if($cates->status)
                            hiển thị
                          @else
                            Không hiển thị
                          @endif
                      </td>
                      <td>{{$cates->category->title}}</td>
                     
                      <td>
                        @foreach($cates->movie_genre as $genre)
                        <span class="badge badge-secondary" style=" font-size: 15px;">{{$genre->title}}</span>
                        @endforeach
                      </td>
                     
                      <td>{{$cates->country->title}}</td>
                      <td>
                          @if($cates->firm_hot == 0)
                            Không
                          @else
                            Có
                          @endif
                      </td>
                      <td>
                          @if($cates->resolution == 0)
                            HD
                          @elseif($cates->resolution == 1)
                            SD
                          @elseif($cates->resolution == 2)
                            HDCam
                          @elseif($cates->resolution == 3)
                           Cam
                          @elseif($cates->resolution == 4)
                            FullHD
                          @else
                            Trailer
                          @endif
                      </td>
                       <td>
                          @if($cates->subtitle == 0)
                            Phụ đề
                          @else
                            Thuyết minh
                          @endif
                      </td>
                      <td>{{$cates->ngaytao}}</td>
                      <td>{{$cates->ngaycapnhat}}</td>
                       <td>{{$cates->episode}}</td>
                      
                      <td>  
                          {!! Form::selectYear('year', 2018, 2023, isset($cates->year) ? $cates->year : '', ['class' => 'select-year', 'id' => $cates->id]) !!}

                      </td>
                     <td>
                          {!! Form::open(['method'=>'DELETE','route'=> ['movie.destroy' ,$cates->id] , 'onsubmit'=>'return confirm("Xác nhận Xoá?")']) !!}
                          {!! Form::submit('Xoá', ['class'=> 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                          <a href="{{route('movie.edit' , $cates->id)}}" class="btn btn-warning">Sửa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
