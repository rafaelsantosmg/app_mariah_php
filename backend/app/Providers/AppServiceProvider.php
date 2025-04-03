<?php

namespace App\Providers;

use App\Interfaces\DailyMovementInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;
use App\Repositories\DailyMovementRepository;
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

    $this->app->bind(DailyMovementInterface::class, DailyMovementRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
