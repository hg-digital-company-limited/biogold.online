<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News; // Nhớ import model News

class NewsDetail extends Component
{
    public $slug; // Thuộc tính để lưu slug
    public $newsItem; // Thuộc tính để lưu thông tin bài viết

    public function mount($slug) // Nhận slug khi khởi tạo
    {
        $this->slug = $slug; // Gán slug
        $this->newsItem = News::where('slug', $this->slug)->first(); // Lấy bài viết dựa trên slug
    }

    public function render()
    {
        return view('livewire.news-detail', [
            'newsItem' => $this->newsItem, // Truyền dữ liệu vào view
        ]);
    }
}