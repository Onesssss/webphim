@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
         
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên Phim</th>
                      <th scope="col">Hình Ảnh Phim</th>
                      <th scope="col">Tập Phim</th>
                      <th scope="col">Link Phim</th>
                      <!-- <th scope="col">Trạng Thái</th> -->
                      <th scope="col">Quản Lý</th>
                    </tr>
                  </thead>
                  <tbody class="order_position">
                    @foreach($list_episode as $key => $episode )
                    <tr>
                      <th scope="row">{{($key+1)}}</th>
                      <td>{{($episode->movie->title)}}</td>
                       <td><img width="100%" src="{{asset('uploads/movie/'.$episode->movie->image)}}"></td>
                      <td>{{($episode->episode)}}</td>
                      <td>{!!$episode->linkphim!!}</td>
                     <!--  <td>
                          @if($episode->status)
                            hiển thị
                          @else
                            Không hiển thị
                          @endif
                      </td> -->
                      <td>
                          {!! Form::open(['method'=>'DELETE','route'=> ['episode.destroy' ,$episode->id] , 'onsubmit'=>'return confirm("Xác nhận Xoá?")']) !!}
                          {!! Form::submit('Xoá', ['class'=> 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                          <a href="{{route('episode.edit' , $episode->id)}}" class="btn btn-warning">Sửa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
