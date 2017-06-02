# Formbuilder for Laravel5

    Step 1 : php artisan make:auth
    Step 2 : composer require msppack/laravelapp
    Step 3 : Add service provider in config/app.php 
            MspPack\LaravelApp\LaravelAppServiceProvider::class,
    Step 4 : add in User model $fillable = [---,'provider','provider_id',---]
    Step 5 : php artisan migrate
    Step 6 : add key into config/services.php 
    		'twitter' => [
		        'client_id' => 'TWITTER_CLIENT_ID',
		        'client_secret' => 'TWITTER_CLIENT_SECRET,
		        'redirect' => 'http://localhost:8000/auth/twitter/callback',
		    ],
	
	replace twitter from redirect url as per your social login like, google,facebook and Add this type array respective social login you want 
    