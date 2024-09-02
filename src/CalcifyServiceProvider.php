<?php

namespace Danyseif\Calcify;

use Danyseif\Calcify\Base\Arithmetic;
use Illuminate\Support\ServiceProvider;

class CalcifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('calcify', function () {
            return new Arithmetic();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
