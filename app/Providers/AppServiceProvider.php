<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('currency', function ($amount) {
            return "<?php echo number_format($amount, 0, '.', '.') . '₫'; ?>";
        });

        View::composer('*', function ($view) {
            $user = Auth::user();
            // if ($user) {
            //     $user->load('role');
            // }
            $view->with('currentUser', $user);
        });

        Paginator::useBootstrap();
    }
}
