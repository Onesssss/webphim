<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
class CountryController extends Controller
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
        $list = Country::all();
        return view('admincp.country.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage. luu tru
     */
    public function store(Request $request)
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $country = new Country();
        $country-> title = $data['title'];
        $country-> description = $data['description'];
        $country-> slug = $data['slug'];
        $country-> status = $data['status'];
        $country->save();
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
        $country = Country::find($id);
        $list = Country::all();
        return view('admincp.country.form',compact('list','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $country =  Country::find($id);
        $country-> title = $data['title'];
        $country-> description = $data['description'];
        $country-> slug = $data['slug'];
        $country-> status = $data['status'];
        $country->save();
        return redirect()->back(); //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
    }

    /**
     * Remove the specified resource from storage.xoa
     */
    public function destroy(string $id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}
