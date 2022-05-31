<?php

namespace App\Providers;

use App\Repositories\ContractRepository;
use App\Repositories\Eloquents\ContractRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\Eloquents\UserRepositoryEloquent;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\Eloquents\EmailTemplateRepositoryEloquent;
use App\Repositories\OrderRepository;
use App\Repositories\Eloquents\OrderRepositoryEloquent;
use App\Repositories\ShopRepository;
use App\Repositories\Eloquents\ShopRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $this->app->bind(ShopRepository::class, ShopRepositoryEloquent::class);
        $this->app->bind(EmailTemplateRepository::class, EmailTemplateRepositoryEloquent::class);
        $this->app->bind(ContractRepository::class, ContractRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
