<?php 

namespace Adong\One;

use Illuminate\Support\ServiceProvider;

class OneServiceProvider extends ServiceProvider
{

      /**
     * @var array
     */
    protected $commands = [
        Console\PublishCommand::class,
        Console\ConfigCommand::class,
        Console\TableCommand::class
    ];

    public function boot()
    {
        // php artisan vendor:publish --tag=adong-one-migrations
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'adong-one-config');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'adong-one-migrations');
        }
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}