<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Invoice_detail;
use App\Models\Invoice_detailppn;
use App\Observers\Invoice_detailObserver; 
use App\Observers\Invoice_detailppnObserver;
use App\Observers\Invoice_customer_detailObserver;  
use Illuminate\Pagination\Paginator;
use App\Models\Invoice;
use App\Models\Invoice_customer_detail;
use App\Models\Invoiceppn;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Invoice_detail::observe(Invoice_detailObserver::class);
        Schema::defaultStringLength(191);
        Invoice_detailppn::observe(Invoice_detailppnObserver::class);
        Schema::defaultStringLength(191);
        Invoice_customer_detail::observe(Invoice_customer_detailObserver::class);
        Paginator::useBootstrap();
        view()->share('alert', Invoice::alert());
        view()->share('alertppn', Invoiceppn::alertppn());
        view()->share('productalert', Product::productalert());
    }
}
