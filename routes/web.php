<?php

use App\Livewire\PostForm;
use App\Livewire\PostList;
use App\Livewire\Posts\CreatePost;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


// Route::get('/posts/create', CreatePost::class);

Route::get('/create-post', CreatePost::class)->middleware(['auth','verified']);

Route::get('/create', PostForm::class)->name('posts.create')->middleware(['auth','verified']);
Route::get('/view', PostList::class)->name('posts.view');

require __DIR__.'/auth.php';
