<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title','id');// sử dụng hàm pluck để truy vấn dữ liệu từ bảng
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->get();//with('category'): Lấy tên hàm từ Movie
        return view('admincp.movie.form',compact('list','genre','country','category'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];       
        $movie->country_id = $data['country_id'];
        $movie->genre_id = $data['genre_id'];
//them hinh anh
        $get_image = $request->file('image');

        //them hinh anh
        if($get_image){
        $get_name_image = $get_image->getClientOriginalName();//abc1.jpg
        $name_image = current(explode('.', $get_name_image));//mảng aray [0]=>abc [1]= jpg
        $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalName();//xyz1234.jpg
        $get_image ->move('uploads/movie/',$new_image);
        $movie->image = $new_image;

        }
        $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $category = Category::pluck('title','id');// sử dụng hàm pluck để truy vấn dữ liệu từ bảng
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->get();
        $movie = Movie::find($id);
        return view('admincp.movie.form',compact('list','genre','country','category','movie'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
           $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];  
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];       
        $movie->country_id = $data['country_id'];
        $movie->genre_id = $data['genre_id'];
//them hinh anh
        $get_image = $request->file('image');

        //Nếu thay hinh anh
        if($get_image){
               if ($movie) {
                // Kiểm tra xem $movie có tồn tại trước khi xóa
                    if (!empty($movie->image)) {
                        unlink('uploads/movie/' . $movie->image);
                }
        $get_name_image = $get_image->getClientOriginalName();//abc1.jpg
        $name_image = current(explode('.', $get_name_image));//mảng aray [0]=>abc [1]= jpg
        $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalName();//xyz1234.jpg
        $get_image ->move('uploads/movie/',$new_image);
        $movie->image = $new_image;
        }
        $movie->save();
        return redirect()->back();
    }
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $movie = Movie::find($id);

    if ($movie) {
        // Kiểm tra xem $movie có tồn tại trước khi xóa
        if (!empty($movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
        
        $movie->delete();
    }

    return redirect()->back();
}
}
