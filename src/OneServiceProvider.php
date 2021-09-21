<?php 

namespace Adong\One;

use Illuminate\Support\ServiceProvider;

class OneServiceProvider extends ServiceProvider
{

      /**
     * @var array
     */
    protected $commands = [
        Console\OneCommand::class,
        Console\TableCommand::class
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'adong-one-config');
        }
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}