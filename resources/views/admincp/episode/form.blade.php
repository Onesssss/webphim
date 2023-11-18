@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                 <style>
                    .center-button {
                        text-align: center;
                    }
                </style>

                <div class="center-button">
                    <a href="{{ route('episode.index') }}" class="btn btn-primary">Liệt Kê Danh Sách Tập Phim</a>
                </div>
                <div class="card-header">Quản lý Phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($episode))
                        {!! Form::open(['route' => 'episode.store', 'method' => 'post','enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route' => ['episode.update' , $episode->id], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                    @endif
                      
                       

                        <div class="form-group">
                            {!! Form::label('movie', 'Chọn phim', []) !!}
                            {!! Form::select('movie_id',['0'=>'Chọn phim','Phim'=>$list_movie], isset($episode) ? $episode->movie_id : '', ['class'=>'form-control select-movie']) !!}
                        </div>   
                   
                        <div class="form-group">
                            {!! Form::label('link', 'Link Phim', []) !!}
                            {!! Form::text('link', isset($episode) ? $episode->linkphim : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>

                        <div class="form-group">
                        {!! Form::label('episode', 'Tập Phim', []) !!}
                        {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...',isset($episode)?'readonly': '']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>
                        
                        @if(!isset($episode))
                            {!! Form::submit('Thêm tập phim', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật tập phim', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!} 

                </div>
            </div>

               
        </div>
    </div>
</div>
@endsection
