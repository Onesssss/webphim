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
        $list = Movie::orderBy('id','DESC')->get();
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
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];       
        $movie->country_id = $data['country_id'];
        $movie->genre_id = $data['genre_id'];
//them hinh anh
        $get_image = $request->file('image');
        $path = 'public/uploads/movie/';

        //them hinh anh
        if($get_image){
        $get_name_image = $get_image->getClientOriginalName();//abc1.jpg
        $name_image = current(explode('.', $get_name_image));//mảng aray [0]=>abc [1]= jpg
        $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalName();//xyz1234.jpg
        $get_image ->move($path,$new_image);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
