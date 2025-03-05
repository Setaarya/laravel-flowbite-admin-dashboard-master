<?php

namespace App\Providers;

use App\Repositories\AdminDashboardRepository;
use App\Repositories\AdminDashboardRepositoryInterface;
use App\Repositories\StaffDashboardRepository;
use App\Repositories\StaffDashboardRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\AdminDashboardService;
use App\Services\AdminDashboardServiceInterface;
use App\Services\StaffDashboardService;
use App\Services\StaffDashboardServiceInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\SupplierRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductAttributeRepository;
use App\Repositories\ProductAttributeRepositoryInterface;
use App\Services\StockTransactionService;
use App\Services\StockTransactionServiceInterface;
use App\Repositories\StockTransactionRepository;
use App\Repositories\StockTransactionRepositoryInterface;
use App\Repositories\StockOpnameRepository;
use App\Repositories\StockOpnameRepositoryInterface;
use App\Services\StockOpnameService;
use App\Services\StockOpnameServiceInterface;
use App\Models\StockTransaction;
use App\Observers\StockTransactionObserver;
use App\Models\Product;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        {
            $this->app->bind(AdminDashboardRepositoryInterface::class, AdminDashboardRepository::class);
            $this->app->bind(AdminDashboardServiceInterface::class, AdminDashboardService::class);
            $this->app->bind(StaffDashboardRepositoryInterface::class, StaffDashboardRepository::class);
            $this->app->bind(StaffDashboardServiceInterface::class, StaffDashboardService::class);
            $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
            $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
            $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
            $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
            $this->app->bind(ProductAttributeRepositoryInterface::class, ProductAttributeRepository::class);
            $this->app->bind(StockTransactionRepositoryInterface::class, StockTransactionRepository::class);
            $this->app->bind(StockTransactionServiceInterface::class, StockTransactionService::class);
            $this->app->bind(StockOpnameRepositoryInterface::class, StockOpnameRepository::class);
            $this->app->bind(StockOpnameServiceInterface::class, StockOpnameService::class);
        }
        

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        StockTransaction::observe(StockTransactionObserver::class);
        Product::observe(ProductObserver::class);
    }
}
