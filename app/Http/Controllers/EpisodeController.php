<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon;
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id','DESC')->get();
        return view('admincp.episode.index',compact('list_episode'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $episode = new Episode();
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['link'];
        $episode->episode = $data['episode'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->back(); //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
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
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        $episode = Episode::find($id);
        return view('admincp.episode.form',compact('episode','list_movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = $request->all();  // trích xuất tất cả dữ liệu gửi từ yêu cầu và lưu vào biến $data. 
        $episode =  Episode::find($id);
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['link'];
        $episode->episode = $data['episode'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->to('episode');; //được sử dụng để chuyển hướng người dùng sau khi dữ liệu đã được lưu thành công
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->route('episode.index');;
    }
    public function select_movie(){
        $id= $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>---Chọn tập phim----</option>';
        for($i=1 ;$i<= $movie->episode; $i++){
            $output.= '<option value="'. $i .'">'.$i.'</option>';
            
        }
        echo $output;
    }
}
