# Formbuilder for Laravel5

    Step 1 : "require": {
				"msppack/laravelapp" : "1.0.0"
			},
    Step 2 : Add service provider in config/app.php 
            MspPack\LaravelApp\LaravelAppServiceProvider::class,
    Step 4 : add in User model $fillable = [---,'provider','provider_id',---]

    Note : if you not create login basic functionality with 'php artisan make:auth' then please do it, otherwise skip it.