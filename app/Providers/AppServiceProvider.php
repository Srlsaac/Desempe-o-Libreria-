<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        config(['database.connections.mysql.engine' => 'InnoDB']);
    }

    public function boot(): void
    {
        //
    }
}
