<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\StoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::post('country/post', [
    App\Http\Controllers\HomeController::class, 'country'
])->name('country_post');

Route::post('register/user',[
    ProfileController::class, 'store'
])->name('register.user');

Route::get('friends',[
    FriendController::class, 'index'
])->name('friends');

Route::get('friend/save/{id}',[
    FriendController::class, 'store'
])->name('friend.add');

Route::get('friend/confirm/{id}',[
    FriendController::class, 'confirm'
])->name('friend.confirm');


Route::get('friend/cancel/{id}',[
    FriendController::class, 'destroy'
])->name('request.cancel');


Route::post('post/save',[
    PostController::class, 'store'
])->name('post.save');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
