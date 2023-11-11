@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(!isset($category))
                        {!! Form::open(['route' => 'category.store', 'method' => 'post']) !!}
                    @else
                        {!! Form::open(['route' => ['category.update' , $category->id], 'method' => 'PUT']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>
                         <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...','id'=>'convert_slug']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'nhập dữliệu...','id'=>'description']) !!}

                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select('status', ['1'=>'hiển thị','0'=>'không hiển thị'], isset($category) ? $category->status : '', ['class'=>'form-control']) !!}
                        </div>
                        @if(!isset($category))
                            {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}

                </div>
            </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Active/Inactive</th>
                      <th scope="col">manage</th>
                    </tr>
                  </thead>
                  <tbody class="order_position">
                    @foreach($list as $key => $cate )
                    <tr id= "{{$cate->id}}">
                      <th scope="row">{{($key+1)}}</th>
                      <td>{{($cate->title)}}</td>
                      <td>{{($cate->description)}}</td>
                      <td>{{($cate->slug)}}</td>
                      <td>
                          @if($cate->status)
                            hiển thị
                          @else
                            Không hiển thị
                          @endif
                      </td>
                      <td>
                          {!! Form::open(['method'=>'DELETE','route'=> ['category.destroy' ,$cate->id] , 'onsubmit'=>'return confirm("Xác nhận Xoá?")']) !!}
                          {!! Form::submit('Xoá', ['class'=> 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                          <a href="{{route('category.edit' , $cate->id)}}" class="btn btn-warning">Sửa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
