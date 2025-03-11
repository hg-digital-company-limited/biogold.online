<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News; // Nhớ import model News

class Home extends Component
{
    public $news; // Định nghĩa biến để lưu trữ tin tức

    public function mount() // Phương thức mount để lấy dữ liệu khi khởi tạo component
    {
        $this->news = News::latest()->get(); // Lấy tất cả tin tức mới nhất
    }

    public function render()
    {
        return view('livewire.home', [
            'news' => $this->news, // Truyền biến news vào view
        ]);
    }
}