<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Models\Product;

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

Route::get('/', [LandingController::class, 'index'])->name('landing');


Route::get('/front/show/product/{id}', [LandingController::class, 'show'])->name('front.show.product');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('isAdmin')->group(function () {
        Route::get('/create/product',[ProductController::class, 'create'])->name('create.product');
        Route::post('/store/product', [ProductController::class, 'store'])->name('store.product');
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
        Route::delete('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/product/show/{id}', [ProductController::class, 'show'])->name('admin.product.show');
        Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');

        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/admin/create/user', [UserController::class, 'create'])->name('admin.create');
        Route::post('/admin/store/user', [UserController::class, 'store'])->name('admin.store');
    });
});

require __DIR__.'/auth.php';



