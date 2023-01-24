<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home_index');
Route::get('/add-product', [HomeController::class, 'add_product']);
Route::get('/add-likes', [HomeController::class, 'add_likes']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::get('/product-detail/{id}', [ProductsController::class, 'showDetail']);
Route::get('/inc-product', [HomeController::class, 'incQuantity']);
Route::get('/dec-product', [HomeController::class, 'decQuantity']);
Route::get('/remove-product', [HomeController::class, 'remove']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/checkout/{id}', [HomeController::class, 'checkout']);
    Route::post('product-detail/{id}/review', [ProductsController::class, 'detailReview'])->name('product-detail');
    Route::post('cart/create-detail', [OrderDetailsController::class, 'createOrderDetail'])->name('create-detail');
    Route::post('checkout/{id}/create-order', [OrderController::class, 'createOrder'])->name('create-order');
    Route::post('/contact',[ContactController::class,'sendMessage']);
    Route::post('/newsletter',[NewsletterController::class,'subscribe']);

});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'can:is_admin'])->prefix('/admin')->group(function () {
    Route::get('/home', [AdminController::class, 'admin']);
    Route::get('/view-users', [AdminController::class, 'viewUsers']);
    Route::get('/view-orders', [AdminController::class, 'viewOrders']);
    Route::get('/view-order/{id}', [AdminController::class, 'viewOrderDetails']);
    
    Route::resource('products', ProductsController::class);
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('products', [ProductsController::class, 'store'])->name('admin.products');
    Route::get('products/create', [ProductsController::class, 'create']);
    Route::get('products/{id}/edit', [ProductsController::class, 'edit']);
    Route::put('products/{id}', [ProductsController::class, 'update']);
    Route::get('products/{id}', [ProductsController::class, 'show']);
    Route::delete('products/{id}', [ProductsController::class, 'destroy']);

    Route::resource('categories', CategoriesController::class);
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::post('categories', [CategoriesController::class, 'store'])->name('admin.categories');
    Route::get('categories/create', [CategoriesController::class, 'create']);
    Route::get('categories/{id}/edit', [CategoriesController::class, 'edit']);
    Route::put('categories/{id}', [CategoriesController::class, 'update']);
    Route::get('categories/{id}', [CategoriesController::class, 'show']);
    Route::delete('categories/{id}', [CategoriesController::class, 'destroy']);
});

