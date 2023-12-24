<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\loginFBController;
use App\Http\Controllers\loginGoogleController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [IndexController::class, 'home'])->name('homepages');

Route::get('/danhmuc/{slug}',[IndexController::class,'getCategory'])->name('danhmuc');
Route::get('/theloai/{slug}',[IndexController::class,'getGenre'])->name('theloai');
Route::get('/quocgia/{slug}',[IndexController::class,'getCountry'])->name('quocgia');
Route::get('/phim/{slug}',[IndexController::class,'getMovie'])->name('phim');
// Route::get('/tag/{tag}',[IndexController::class,'getTag'])->name('tag');
Route::get('/tim-kiem',[IndexController::class,'searchMovie'])->name('timKiem');
Route::get('xem-phim/{slug}/{tap}',[IndexController::class,'watchMovie']);
Route::get('tap-phim',[IndexController::class,'episode'])->name('tapphim');
Route::get('select-movie', [EpisodeController::class,'selectMovie'])->name('selectMovie');
Route::get('xem-tap-phim/{id}', [EpisodeController::class,'viewEpisode'])->name('viewEpisode');
Route::get('them-tap-phim/{id}', [EpisodeController::class,'addEpisode'])->name('addEpisode');
Route::get('/locphim', [EpisodeController::class,'addEpisode'])->name('locphim');

Route::post('/rating', [EpisodeController::class,'addRating'])->name('add-rating');



//route dang nhap admin
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route admin
Route::resource('category', CategoryController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('movie', MovieController::class);
Route::resource('episode', EpisodeController::class);
Route::resource('info', InfoController::class);


//thay doi dữ liệu movie bằng ajax
Route::get('/category-choose',[Movie::class,'categoryUpdate'])->name('categoryUpdate');

//login google và login facebook
Route::get('dang-nhap',[UserController::class,'pageLogin'])->name('dangnhap');
Route::get('auth/google', [loginGoogleController::class, 'redirectToGoogle'])->name('loginGoogle');
Route::get('auth/google/callback', [loginGoogleController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [loginFBController::class, 'facebookRedirect'])->name('loginFacebook');
Route::get('auth/facebook/callback', [loginFBController::class, 'loginWithFacebook']);

// leech movie
Route::get('leech-movie',[LeechMovieController::class,'leechMovie'])->name('leechMovie');




