<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard'); // Главная страница админки
    })->name('admin.dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
})->name('storage');


Route::get('/', function () {
    return Inertia::render('Home', [
        'pizzas' => \App\Models\Product::with('sizes')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'image' => $product->image ? asset('storage/' . $product->image) : null,
                'sizes' => $product->sizes->map(function ($size) {
                    return [
                        'size' => $size->size,
                        'price' => $size->price,
                    ];
                }),
            ];
        }),
    ]);
});

Route::post('/cart/add/{id}', [CartController::class, 'add']);

Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/remove', [CartController::class, 'remove']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/checkout', [CartController::class, 'checkout']);

Route::get('/cart', [CartController::class, 'index'])->name('cart');
