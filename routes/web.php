<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HomeController;


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

Route::get('/', [DashboardController::class, 'index'])->name('index');


Route::get('/home', [HomeController::class, 'index'])->name('home');


/////////////////////////////////////////////
// Resource routes for users
Route::resource('users', UserController::class);

// Resource routes for suppliers
Route::resource('suppliers', SupplierController::class);

// Resource routes for products
Route::resource('products', ProductController::class);

// Resource routes for categories
Route::resource('categories', CategoryController::class);

// Resource routes for product attributes
Route::resource('product_attributes', ProductAttributeController::class);

// Resource routes for stock transactions
Route::resource('stock_transactions', StockTransactionController::class);

/////////////////////////////////////////////////////////////



// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');



Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');
    });

    Route::middleware(['role:Manajer Gudang'])->group(function () {
        Route::get('/manajer/home', [ManajerController::class, 'index'])->name('manager_home');
    });

    Route::middleware(['role:Staff Gudang'])->group(function () {
        Route::get('/staff/home', [StaffController::class, 'index'])->name('staff_home');
    });
});

?>
