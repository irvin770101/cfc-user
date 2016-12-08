<?php

namespace KSD\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Log;

class MemberServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/acl.php' => config_path('acl.php'),
        ]);
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Member', function($app) {
            return $app->make('KSD\Member\Services\MemberService');
        });
    }
}
