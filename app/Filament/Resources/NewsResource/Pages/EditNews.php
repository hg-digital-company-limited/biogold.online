<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str; // Đảm bảo import Str

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('clone')
                ->label('Clone')
                ->action('clone')
                ->icon('heroicon-o-newspaper'),
        ];
    }
    public function clone()
    {
        $original = $this->record;

        // Tạo bản sao bài viết
        $clone = $original->replicate();
        
        // Kiểm tra slug có bị trùng hay không
        $baseSlug = Str::slug($clone->ten);
        $slug = $baseSlug;
        $count = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $clone->slug = $slug;
        $clone->save();

        // Chuyển hướng đến trang chỉnh sửa của bài viết mới
        return redirect()->back();
    }
}
