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
                    <a href="{{ route('movie.index') }}" class="btn btn-primary">Liệt kê phim</a>
                </div>
                <div class="card-header">Quản lý Phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(!isset($movie))
                        {!! Form::open(['route' => 'movie.store', 'method' => 'post','enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route' => ['movie.update' , $movie->id], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                    @endif
                      
                        <div class="form-group">
                            {!! Form::label('title', 'Tên Phim', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>

                          <div class="form-group">
                            {!! Form::label('episode', 'Số tập phim', []) !!}
                            {!! Form::text('episode', isset($movie) ? $movie->episode : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>

                         <div class="form-group">
                            {!! Form::label('trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...']) !!}
                                                        <!--  if,else rút gọn  -->
                        </div>

                        <div class="form-group">
                            {!! Form::label('thoiluongphim', 'Thời lượng phim', []) !!}
                            {!! Form::text('thoiluongphim', isset($movie) ? $movie->thoiluongphim : '', ['class' => 'form-control', 'placeholder' => 'nhập dữ liệu...']) !!}

                                                        <!--  if,else rút gọn  -->
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Đường dẫn', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder'=>'nhập dữ liệu...','id'=>'convert_slug']) !!}

                                                        <!--  if,else rút gọn  -->
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'nhập dữ liệu...','id'=>'description']) !!}
                        <div class="form-group">
                            {!! Form::label('Active', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1'=>'hiển thị','0'=>'không hiển thị'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('resolution', 'Định dạng', []) !!}
                            {!! Form::select('resolution', ['0'=>'HD','1'=>'SD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('subtitle', 'Phụ đề', []) !!}
                            {!! Form::select('subtitle', ['0'=>'Phụ đề','1'=>'Thuyết minh'], isset($movie) ? $movie->subtitle : '', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Category', 'Danh mục', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category : '', ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Genre', 'Thể loại', []) !!} <br>
                            <!-- {!! Form::select('genre_id',$genre, isset($movie) ? $movie->genre : '', ['class'=>'form-control']) !!} -->
                            @foreach($list_genre as $key => $gen)
                                @if(isset($movie))
                                {!! Form::checkbox('genre[]', $gen->id,  isset($movie->genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                                @else
                                {!! Form::checkbox('genre[]', $gen->id, '') !!}
                                @endif
                                {!! Form::label('genre', $gen->title) !!}
                            @endforeach
                        </div> 

                        <div class="form-group">
                            {!! Form::label('Country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country : '', ['class'=>'form-control']) !!}
                        </div>   

                        <div class="form-group">
                            {!! Form::label('hot', 'Phim hot', []) !!}
                            {!! Form::select('firm_hot', ['1'=>'Có','0'=>'không '], isset($movie) ? $movie->firm_hot : '', ['class'=>'form-control']) !!}
                        </div>   

                        <div class="form-group">
                            {!! Form::label('Image', 'Hình Ảnh', []) !!}
                            {!! Form::file('image', ['class'=>'form-control-file']) !!}
                        </div>                       
                        
                        
                        @if(!isset($movie))
                            {!! Form::submit('Thêm phim', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}

                </div>
            </div>

               
        </div>
    </div>
</div>
@endsection
