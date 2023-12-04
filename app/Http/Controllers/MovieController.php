<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie_Genre;
use App\Models\Episode;
use carbon\Carbon;
use Storage;
use File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category','movie_genre','country','genre')->orderBy('id','DESC')->get();//with('category'): Lấy tên hàm từ Movie
        
        
        $path = public_path()."/json/";

        if(!is_dir($path)){
            mkdir($path,0777,true);//0777: Toàn quyền thêm,sửa,xoá
        }
        File::put($path.'movies.json',json_encode($list));

        return view('admincp.movie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title','id');// sử dụng hàm pluck để truy vấn dữ liệu từ bảng
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list_genre = Genre::all();
        return view('admincp.movie.form',compact('category','genre','country','list_genre'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->episode = $data['episode'];
        $movie->trailer = $data['trailer'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->firm_hot = $data['firm_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];       
        $movie->country_id = $data['country_id'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->thoiluongphim = $data['thoiluongphim'];
        //thêm nhiều thể loại phim
        foreach($data['genre'] as $key=>$gen){
            $movie->genre_id = $gen[0];// lưu 1 thể loại trc sau đó mới lưu nhiều thể loại
        }


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
        //Thêm nhiều thể loại cho phim
        $movie->movie_genre()->attach($data['genre']);// attach: thêm vào nhiều thể loại
        // return redirect()->back();
        return redirect()->route('movie.index');
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
    public function edit( $id)
    { 
        $category = Category::pluck('title','id');// sử dụng hàm pluck để truy vấn dữ liệu từ bảng
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $movie = Movie::find($id);
        $list_genre = Genre::all();
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form',compact('category','genre','country','movie','list_genre','movie_genre'));
    }
    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
           $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->episode = $data['episode'];
        $movie->trailer = $data['trailer'];
        $movie->resolution = $data['resolution'];
        $movie->subtitle = $data['subtitle'];
        $movie->firm_hot = $data['firm_hot'];
        $movie->slug = $data['slug'];  
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];       
        $movie->country_id = $data['country_id'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->thoiluongphim = $data['thoiluongphim'];
        foreach($data['genre'] as $key=>$gen){
                    $movie->genre_id = $gen[0];// lưu 1 thể loại trc sau đó mới lưu nhiều thể loại
                }

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
        //update thể loại 
        $movie->movie_genre()->sync($data['genre']);// sync: đồng bộ dữ liệu 

        return redirect()->route('movie.index');
    }
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $movie = Movie::find($id);
//xoa anh
       if ($movie) {
        // Kiểm tra xem $movie có tồn tại trước khi xóa
        if (!empty($movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
//xoa the loai  
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        // $movie->delete();

//xoá tập phim
         Episode::whereIn('movie_id',[$movie->id])->delete();
        $movie->delete();
    }

    return redirect()->back();
}
}
