<?php

use App\Livewire\About;
use App\Livewire\Home;
use App\Livewire\News;
use App\Livewire\NewsDetail;
use App\Livewire\ProductDetail;
use App\Livewire\ProductList;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/products', ProductList::class)->name('product.list');
Route::get('/products/{id}', ProductDetail::class)->name('product.detail');
Route::get('/about', About::class)->name('about');
Route::get('/news', News::class)->name('news');
Route::get('/news/{slug}', NewsDetail::class)->name('news.detail');
