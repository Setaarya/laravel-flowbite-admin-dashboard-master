<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD\UserController;
use App\Http\Controllers\CRUD\SupplierController;
use App\Http\Controllers\CRUD\ProductController;
use App\Http\Controllers\CRUD\CategoryController;
use App\Http\Controllers\CRUD\ProductAttributeController;
use App\Http\Controllers\CRUD\StockTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\manager\ManajerController;
use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserSettingController;


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
Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
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


Route::get('/settings', [UserSettingController::class, 'index'])->name('settings.index');
Route::post('/settings/update', [UserSettingController::class, 'update'])->name('settings.update');


// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
////////////////////////////////////////////////////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');
    });

    Route::middleware(['role:Manajer Gudang'])->group(function () {
        Route::get('/manager/home', [ManajerController::class, 'index'])->name('manager_home');
        Route::get('/manager/products/index', [ProductController::class, 'managerIndex'])->name('manager.products.index');
    Route::get('/manager/products/show', [ProductController::class, 'managerShow'])->name('manager.products.show');
    });

    Route::middleware(['role:Staff Gudang'])->group(function () {
        Route::get('/staff/home', [StaffController::class, 'index'])->name('staff_home');
        Route::get('/stock-transactions/pending', [StockTransactionController::class, 'pending'])->name('stock_transactions.pending');
        Route::patch('/stock-transactions/{id}/confirm', [StockTransactionController::class, 'confirm'])->name('stock_transactions.confirm');
        Route::get('/stock_transactions/staff_index', [StockTransactionController::class, 'staffIndex'])->name('stock_transactions.staff_index');
    });
});
/////////////////////////////////////////////////////////////////////////////////




Route::middleware(['auth'])->group(function () {
    Route::middleware('role:manager')->group(function () {
        Route::get('/stock-transactions/create', [StockTransactionController::class, 'create'])->name('stock-transactions.create');
        Route::post('/stock-transactions', [StockTransactionController::class, 'store'])->name('stock-transactions.store');
    });


    Route::middleware('role:admin')->group(function () {
        Route::get('/stock-transactions', [StockTransactionController::class, 'index'])->name('stock-transactions.index');
        Route::delete('/stock-transactions/{id}', [StockTransactionController::class, 'destroy'])->name('stock-transactions.destroy');
    });
});


?>
