<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Include all php files from Helpers directory
        foreach (glob(app()->path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrap();
        // User bootstrap pagination
        Paginator::useBootstrapFour();
        Paginator::useBootstrapFive();

        // Create macro builder for where like
        Builder::macro('whereLike', function(string $column, $search = '') {
            $search = (string) trim($search);
            if($search != '') {
                $this->where($column, 'LIKE', '%' . $search . '%');
            }

            return $this;
        });
    }
}
