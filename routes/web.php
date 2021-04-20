<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\FilmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\LoginUserController;

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

//Route default

//Route admin
Route::get('/admin/login', [LoginAdminController::class, 'login'])->name('admin_login');
Route::post('/admin/perform-login', [LoginAdminController::class, 'performLogin'])->name('performLoginAdmin');
Route::middleware('auth:admin')->group( function (){
    Route::get('/admin/index', [HomeAdminController::class, 'index'])->name('admin_index');
    Route::post('/admin/update-profile', [HomeAdminController::class, 'updateProfile'])->name('admin_update_profile');
    Route::post('/admin/update-avatar', [HomeAdminController::class, 'updateAvatar'])->name('admin_update_avatar');

    Route::get('/admin/film/index', [FilmController::class, 'index'])->name('film_index');
    Route::get('/admin/film/destroy/{id}', [FilmController::class, 'destroy'])->name('film_destroy');
    Route::get('/admin/film/create', [FilmController::class, 'create'])->name('film_create');
    Route::post('/admin/film/store', [FilmController::class, 'store'])->name('film_store');
    Route::get('/admin/film/edit/{id}', [FilmController::class, 'edit'])->name('film_edit');
    Route::post('/admin/film/update', [FilmController::class, 'update'])->name('film_update');

    Route::get('/admin/episode/index/{id}', [EpisodeController::class, 'index'])->name('episode_index');
    Route::get('/admin/episode/destroy/{id}', [EpisodeController::class, 'destroy'])->name('episode_destroy');
    Route::get('/admin/episode/create/{id}', [EpisodeController::class, 'create'])->name('episode_create');
    Route::post('/admin/episode/store', [EpisodeController::class, 'store'])->name('episode_store');
    Route::get('/admin/episode/edit/{id}', [EpisodeController::class, 'edit'])->name('episode_edit');
    Route::post('/admin/episode/update', [EpisodeController::class, 'update'])->name('episode_update');

    Route::get('/admin/category/index', [CategoryController::class, 'index'])->name('category_index');
    Route::get('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category_destroy');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('category_update');

    Route::get('/admin/user/index', [UserController::class, 'index'])->name('user_index');
    Route::get('/admin/user/destroy/{id}', [UserController::class, 'destroy'])->name('user_destroy');

    Route::get('/admin/logout',[LoginAdminController::class, 'logout'])->name('logout');
});

//Route User
Route::get('/', [HomeController::class, 'index'])->name('user_home_index');
Route::get('/login', [LoginUserController::class, 'login'])->name('user_login');
Route::get('/signup', [LoginUserController::class, 'signup'])->name('user_signup');
Route::post('/perform-login', [LoginUserController::class, 'performLogin'])->name('performLoginUser');
Route::post('/perform-signup', [LoginUserController::class, 'performSignup'])->name('performSignupUser');
Route::post('/check-email', [LoginUserController::class, 'checkEmail'])->name('checkEmail');
Route::post('/check-user-name', [LoginUserController::class, 'checkUserName'])->name('checkUserName');
Route::get('/search/{value}', [HomeController::class, 'search'])->name('user_home_search');

Route::middleware('auth:web')->group( function (){

});

//multi language
Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])->name('change-language');
Route::get('language', [HomeController::class, 'getLanguage'])->name('getLanguage');







