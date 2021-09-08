<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

Route::get('/', function () {
    return view('welcome', ['products' => Product::orderByDesc('created_at')->take(5)->simplePaginate(5)->items()]);
});

Route::get('/products', function () {

    if(request()->query('search')) {
        $search = request()->query('search');
        $products = Product::where('title', 'LIKE', "%{$search}%")->simplePaginate(12);
    } else {
        $products = Product::simplePaginate(12);
    }
    return view('products',['products' => $products]);
})->name('products');

// Contact us routes
Route::get('/contact', [App\Http\Controllers\ContactUsController::class, 'index'])->name('contactUs');
Route::post('/contact', [App\Http\Controllers\ContactUsController::class, 'createQuestion'])->name('contactUs');
Route::get('/', [FrontendController::class, 'welcome'])->name('home');

Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'userOrder']);


Auth::routes();

//AUTH ROUTES
Route::middleware('auth')->group(function() {
    Route::middleware('isStaff')->group(function() {
        //ADMIN ROUTES
        Route::prefix('admin')->as('admin.')->group(function() {
            Route::get('/', [AdminController::class, 'index']);
            
            //USER ROUTE
            Route::middleware('isAdmin')->group(function() {
                Route::post('/user/{user}/trash', [UsersController::class, 'trash'])->name('user.trash');
                Route::post('/user/{user}/restore', [UsersController::class, 'restore'])->name('user.restore');
                Route::resource('/user', UsersController::class);
            });
            
            //PRODUCT ROUTE
            Route::get('/product/trashed', [ProductController::class, 'trashed'])->name('product.trashed');
            Route::post('/product/{product}/trash', [ProductController::class, 'trash'])->name('product.trash');
            Route::post('/product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
            Route::resource('/product', ProductController::class);
            
            //ORDERS ROUTES
            Route::post('/orders/accept/{order}', [OrdersController::class, 'accept'])->name('order.accept');
            Route::post('/orders/decline/{order}', [OrdersController::class, 'decline'])->name('order.decline');
            Route::get('/orders/accepted', [OrdersController::class, 'accepted'])->name('order.accepted');
            Route::get('/orders/declined', [OrdersController::class, 'declined'])->name('order.declined');
            Route::resource('/orders', OrdersController::class)->except(['store','destroy','show']);

            // CONTACT US 
            Route::get('/messages', [App\Http\Controllers\ContactUsController::class, 'readQuestions']);
        });
    });

    // LOGOUT
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    
    //STORE ORDER ROUTE
    Route::post('/order/store', [OrdersController::class, 'store'])->name('order.store');
});
