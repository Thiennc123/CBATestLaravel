<?php

namespace App\Providers;

use App\Repositories\Type\TypeRepository;
use App\Repositories\Type\TypeRepositoryInterface;

use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeRepositoryInterface;


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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
    }
}
