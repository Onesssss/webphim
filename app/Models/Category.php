<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;//thêm hoặc cập nhật dữ liệu vào bảng tương ứng trong cơ sở dữ liệu sẽ không cập nhật các cột  ngày tạo và  ngày cập nhật
    use HasFactory;
}
