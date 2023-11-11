@extends('layouts.app')

@section('content')
<div class="container">
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
                      <th scope="col">Title</th>
                      <th scope="col">Image</th>
                      <th scope="col">Description</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Active/Inactive</th>
                      <th scope="col">Category</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Country</th> 
                      <th scope="col">Phim Hot</th>                     
                      <th scope="col">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $key => $cates )
                    <tr>
                      <th scope="row">{{($key+1)}}</th>
                      <td>{{($cates->title)}}</td>
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
                      <td>{{$cates->genre->title}}</td>
                      <td>{{$cates->country->title}}</td>
                      <td>
                          @if($cates->firm_hot == 0)
                            Không
                          @else
                            Có
                          @endif
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
