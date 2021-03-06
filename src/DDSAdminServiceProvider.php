<?php namespace MspPack\DDSAdmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Router;

class DDSAdminServiceProvider extends ServiceProvider {


    //protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/resources' => resource_path('views'),
            __DIR__.'/database/seeds' => database_path('seeds'),
        ]);
        $this->publishes([
            __DIR__.'/public' => public_path(),
        ]);

        if (Schema::hasTable('settings')) {
            $settings = \DB::table('settings')->get()->first();
            if (!empty($settings)) {
                \Config::set(['services.twitter.client_id'=>$settings->twitter_client_id]);     
                \Config::set(['services.twitter.client_secret'=>$settings->twitter_client_secret]);     
                
                \Config::set(['services.google.client_id'=>$settings->google_client_id]);       
                \Config::set(['services.google.client_secret'=>$settings->google_client_secret]);       

                \Config::set(['services.facebook.client_id'=>$settings->facebook_client_id]);       
                \Config::set(['services.facebook.client_secret'=>$settings->facebook_client_secret]);       

                \Config::set(['services.pinterest.client_id'=>$settings->pinterest_client_id]);     
                \Config::set(['services.pinterest.client_secret'=>$settings->pinterest_client_secret]);

                \Config::set(['services.linkedin.client_id'=>$settings->linkedin_client_id]);       
                \Config::set(['services.linkedin.client_secret'=>$settings->linkedin_client_secret]);       
                
                \Config::set(['mail.driver'=>$settings->mail_driver]);
                \Config::set(['mail.host'=>$settings->mail_host]);
                \Config::set(['mail.port'=>$settings->mail_port]);
                \Config::set(['mail.username'=>$settings->mail_username]);
                \Config::set(['mail.password'=>$settings->mail_password]);
                \Config::set(['mail.encryption'=>$settings->mail_encryption]);
            }
        }
        \Config::set(['auth.providers.users.model'=>\MspPack\DDSAdmin\User::class]);
        \Config::set(['auth.providers.users.table'=>'users']);
        \Config::set(['cache.default' => 'array' ]);
        \Config::set(['entrust.role' => 'MspPack\DDSAdmin\Role' ]);
        \Config::set(['entrust.permission' => 'MspPack\DDSAdmin\Permission' ]);
        \Config::set(['entrust.user' => \MspPack\DDSAdmin\User::class]);

        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
            $router->aliasMiddleware('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
            $router->aliasMiddleware('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);
        } else {
            $router->middleware('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
            $router->middleware('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
            $router->middleware('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);
        }

        \Validator::extend('alpha_space', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        \Schema::defaultStringLength(191);
    }
    public function register()
    {
        $this->app->register('Laravel\Socialite\SocialiteServiceProvider');
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $this->app->register('Zizaco\Entrust\EntrustServiceProvider');
        $this->app->register('Arcanedev\NoCaptcha\NoCaptchaServiceProvider');
        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Socialite', 'Laravel\Socialite\Facades\Socialite');
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');
        $loader->alias('Entrust', 'Zizaco\Entrust\EntrustFacade');
        $loader->alias('Captcha', 'Arcanedev\NoCaptcha\Facades\NoCaptcha');
    }
}
