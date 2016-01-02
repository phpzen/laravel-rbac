<?php
namespace PHPZen\LaravelRbac;

use Illuminate\Support\ServiceProvider;
use Blade;

class RbacServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred
     *
     * @var bool
     */
    protected $defer = false;

    public function register()
    {

    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => base_path('/database/migrations')
        ]);
        Blade::directive('ifUserIs', function($expression){
            return "<?php if(Auth::check() && Auth::user()->hasRole{$expression}): ?>";
        });
        Blade::directive('ifUserCan', function($expression){
            return "<?php if(Auth::check() && Auth::user()->canDo{$expression}): ?>";
        });
    }
}