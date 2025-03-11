<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten',  // Tên tin tức
        'slug', // Slug tin tức
        'anh',  // Ảnh tin tức
        'noi_dung', // Nội dung tin tức
        'short_description', // Trạng thái tin tức
    ];
}
