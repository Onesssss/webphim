<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;//thêm hoặc cập nhật dữ liệu vào bảng tương ứng trong cơ sở dữ liệu sẽ không cập nhật các cột  ngày tạo và  ngày cập nhật
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id');//dem khoá phụ của movie.category_id so sánh với category.id
    }
     public function country(){
        return $this->belongsTo(Country::class,'country_id');//dem khoá phụ của movie.category_id so sánh với category.id       
    }
     public function genre(){
        return $this->belongsTo(Genre::class,'genre_id');//dem khoá phụ của movie.category_id so sánh với category.id       
    }
    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genre','movie_id','genre_id');
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
}
