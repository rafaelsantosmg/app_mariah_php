<?php

namespace App\Providers;

use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(ProductInterface::class, ProductRepository::class);
    $this->app->bind(SaleInterface::class, SaleRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
