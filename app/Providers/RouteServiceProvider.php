<?php

namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
        ->group(base_path('routes/web.php'));

    // Route::middleware('api')
    //     ->prefix('api')
    //     ->group(base_path('routes/api.php'));

    // Daftarkan middleware kustom
    Route::aliasMiddleware('role', RoleMiddleware::class);
    }
}
