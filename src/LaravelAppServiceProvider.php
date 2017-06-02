<?php namespace MspPack\LaravelApp;

use Illuminate\Support\ServiceProvider;

class LaravelAppServiceProvider extends ServiceProvider {


	//protected $defer = false;

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/resource' => resource_path('views'),
        ]);
	}
	public function register()
	{
		$this->app->register('Laravel\Socialite\SocialiteServiceProvider');
	    /*
	     * Create aliases for the dependency.
	     */
	    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
	    $loader->alias('Socialite', 'Laravel\Socialite\Facades\Socialite');
	}
}
