<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    use HasFactory;
        public function movie(){
        return $this->belongsTo(Movie::class,'movie_id');//dem khoá phụ của movie.category_id so sánh với category.id       
    }
}
