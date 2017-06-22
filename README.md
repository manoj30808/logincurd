# Laravel5.4 Basic Functionality Curd

    Step 1 : php artisan make:auth
    Step 2 : composer require msppack/ddsadmin
    Step 3 : Add service provider in config/app.php 
            MspPack\DDSAdmin\DDSAdminServiceProvider::class,
    Step 4 : php artisan vendor:publish
    Step 5 : php artisan migrate
    Step 6 : php artisan db:seed --class=UsersTableSeeder
    