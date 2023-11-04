<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.lietke
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
        $list = Category::all();
        return view('admincp.category.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage. luu tru
     */
    public function store(Request $request)
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $category = new Category();
        $category-> title = $data['title'];
        $category-> slug = $data['slug'];
        $category-> description = $data['description'];
        $category-> status = $data['status'];
        $category->save();
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
        $category = Category::find($id);
        $list = Category::all();
        return view('admincp.category.form',compact('list','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $category =  Category::find($id);
        $category-> title = $data['title'];
        $category-> slug = $data['slug'];
        $category-> description = $data['description'];
        $category-> status = $data['status'];
        $category->save();
        return redirect()->back(); //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
    }

    /**
     * Remove the specified resource from storage.xoa
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
}
