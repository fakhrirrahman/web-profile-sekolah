<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Hanya aktif di production (InfinityFree), tidak mengganggu development lokal
        if ($this->app->environment('production')) {
            $this->app->bind('path.public', function () {
                return base_path('../');
            });
        }
    }

    public function boot(): void
    {
        //
    }
}

