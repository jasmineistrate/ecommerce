<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
        Route::get('/admin/edit/user/{user}', [UserController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.update.user');
        Route::get('/admin/user/show/{id}', [UserController::class, 'show'])->name('admin.show.user');
        Route::delete('/admin/user/delete/{id}', [UserController::class, 'delete'])->name('admin.delete.user');

        Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.order');
        Route::get('/admin/create/order', [OrderController::class, 'create'])->name('admin.create.order');
        Route::post('/admin/store/order', [OrderController::class, 'store'])->name('admin.store.order');
        Route::delete('/admin/delete/order/{id}', [OrderController::class, 'delete'])->name('admin.delete.order');
        Route::get('/admin/edit/order/{id}', [OrderController::class, 'edit'])->name('admin.edit.order');
        Route::put('/admin/update/order/{id}', [OrderController::class, 'update'])->name('admin.update.order');
        Route::get('/admin/show/order/{id}', [OrderController::class, 'show'])->name('admin.show.order');


    });
    Route::get('/checkout/index', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/payment', [CheckoutController::class, 'setPayment']);
    Route::get('/payment/success', [CheckoutController::class, 'successPayment']);
    Route::get('/orders', [OrderController::class, 'simpleUserOrders'])->name('orders');
});

Route::get('/cart/items', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');


Route::get('/users/test/model', function(){
    $users = App\Models\User::all();
    //dd($users);
    return view('test');
});

Route::get('/users/test/selectDB', function(){
    $users = DB::select('SELECT * FROM users');
    //dd($users);
    return view('test2');
});



require __DIR__.'/auth.php';



