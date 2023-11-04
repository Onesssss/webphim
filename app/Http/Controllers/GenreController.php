<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource. tao
     */
    public function create()
    {
        $list = Genre::all();
        return view('admincp.genre.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage. luu tru
     */
    public function store(Request $request)
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $genre = new Genre();
        $genre-> title = $data['title'];
        $genre-> description = $data['description'];
        $genre-> slug = $data['slug'];
        $genre-> status = $data['status'];
        $genre->save();
        return redirect()->back(); //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
    }

    /**
     * Display the specified resource. show
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource. chinh sua
     */
    public function edit(string $id)
    {
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.form',compact('list','genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $genre =  Genre::find($id);
        $genre-> title = $data['title'];
        $genre-> description = $data['description'];
        $genre-> slug = $data['slug'];
        $genre-> status = $data['status'];
        $genre->save();
        return redirect()->back(); //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
    }

    /**
     * Remove the specified resource from storage.xoa
     */
    public function destroy(string $id)
    {
        Genre::find($id)->delete();
        return redirect()->back();
    }
}
