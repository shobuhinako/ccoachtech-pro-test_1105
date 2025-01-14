<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;

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

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('show.register');
Route::post('/register', [AuthController::class, 'create'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function()
{
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/shops/{shop:id}/favorite', [ShopController::class, 'favorite'])->name('favorite');
    Route::delete('/mypage/favorite/{shop_id}', [ShopController::class, 'destroy'])->name('destroy.favorite');
    Route::get('/search', [ShopController::class, 'search'])->name('search');
    Route::get('/shop_detail/{id}', [ShopController::class, 'showDetail'])->name('shop_detail');
    Route::get('/review/{id}', [ReviewController::class, 'showReview'])->name('show.review');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('store.review');
    Route::post('/review/delete/{shop_id}', [ReviewController::class, 'remove'])->name('remove.review');
    Route::get('/display/reviews/{shop_id}', [ReviewController::class, 'showShopReviews'])->name('display.reviews');
    Route::post('/display/reviews/delete/{shop_id}', [ReviewController::class, 'deleteReview'])->name('delete.review');
    Route::get('/sort', [ShopController::class, 'sort'])->name('sort');
    Route::get('/admin/import', [ShopController::class, 'showImportForm'])->name('show.import.form');
    Route::post('/admin/import', [ShopController::class, 'importCsv'])->name('shop.import.csv');
    Route::post('/upload/image', [ShopController::class, 'uploadImage'])->name('upload.image');
    Route::post('/reservation/complete', [ShopController::class, 'reservation'])->name('make.reservation');
});
