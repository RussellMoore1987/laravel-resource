// @ to build this project
    // composer create-project laravel/laravel="8.4.*" laravel_test

// @ start up application
    // php artisan serve

// @ list of routes
    // php artisan route:list

// @ php artisan
    // php artisan help make:controller

    // php artisan make:controller PostsController
    // php artisan make:model Post
    // php artisan make:migration create_posts_table

// @ run migration
    // php artisan migrate

    // place holder
        // php artisan migrate:fresh

    // if adding colum make sure to create a new migration for additional database columns

    // * migrate
        // migrate:fresh        Drop all tables and re-run all migrations
        // migrate:install      Create the migration repository
        // migrate:refresh      Reset and re-run all migrations
        // migrate:reset        Rollback all database migrations
        // migrate:rollback     Rollback the last database migration
        // migrate:status       Show the status of each migration