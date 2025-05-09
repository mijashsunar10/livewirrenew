<?php

use App\Http\Livewire\AvatarUpload;
use App\Http\Livewire\ProfileUpdate;
use App\Livewire\PostEdit;
use App\Livewire\PostForm;
use App\Livewire\PostList;
use App\Livewire\New\CreatePost;
use App\Livewire\New\ViewList;
use App\Livewire\TrashPosts;
use GuzzleHttp\Promise\Create;
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
Route::get('/posts/edit/{id}',PostEdit::class)->name('posts.edit');
Route::get('/trash', TrashPosts::class)->name('posts.trash');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile/avatar', AvatarUpload::class)->name('profile.avatar');
// });
// 
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile/update', ProfileUpdate::class)->name('profile.update');
// });

// Route::get('/new/create',CreatePost::class)->name('new.create')->middleware('auth','verified');
// Route::get('/new/view',ViewList::class)->name('new.view')->middleware('auth','verified');

require __DIR__.'/auth.php';
