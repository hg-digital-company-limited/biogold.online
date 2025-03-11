<?php

namespace App\Livewire;

use App\Models\News as ModelsNews;
use Livewire\Component;

class News extends Component
{
    public $newsList; // Thuộc tính để lưu trữ danh sách bài viết

    public function mount() // Phương thức mount để lấy dữ liệu khi khởi tạo component
    {
        $this->newsList = ModelsNews::latest()->get(); // Lấy tất cả bài viết mới nhất
    }

    public function render()
    {
        return view('livewire.news', [
            'newsList' => $this->newsList, // Truyền danh sách bài viết vào view
        ]);
    }
}
