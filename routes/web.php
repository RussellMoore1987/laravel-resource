<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// # home
    Route::get('/contact', function () {
        return '<h1>Contact me!</h1>';
    })->name('home.contact'); // http://127.0.0.1:8000/contact

    Route::get('/test', function () {
        return request('name');
    })->name('home.test'); // http://127.0.0.1:8000/test?name=Russell%20Moore

// # user
    // * using route patterns 
    Route::get('/user/{id}', function ($id = null) {
        return "User with id of {$id}";
    })->name('user.id'); // http://127.0.0.1:8000/user/22  -  http://127.0.0.1:8000/user/Russell%20Moore = fails // path to patterns app\Providers\RouteServiceProvider.php // Works like the one below, but automatically checks for a number whenever we use a variable for ID {id}
    
    // * specifying where ID is a number
    // Route::get('/user/{id}', function ($id = null) {
    //     return "User with id of {$id}";
    // })->where([
    //     'id' => '[0-9]+'
    // ])->name('user.id'); // http://127.0.0.1:8000/user/22  -  http://127.0.0.1:8000/user/Russell%20Moore = fails

    // * optional parameter
    Route::get('/user/{name?}', function ($name = null) {
        return "User with name of \"{$name}\"";
    })->name('user.name'); // http://127.0.0.1:8000/user/  or  http://127.0.0.1:8000/user/Russell%20Moore // optional {name?}

    // TODO: get code from cole on any route and gives back other part of route to process global API
// # post
    // * wildcard
    // Route::get('/post/{slug}', function ($slug) {
    //     return $slug;
    // })->name('post.home'); // http://127.0.0.1:8000/post/hi-there

    // * optional parameter
    Route::get('/recent-posts/{daysAgo?}', function ($daysAgo = 0) {
        return 'Recent Posts - ' . $daysAgo . ' days ago';
    })->name('post.recent.index'); // http://127.0.0.1:8000/recent-posts or http://127.0.0.1:8000/recent-posts/30 // optional {daysAgo?} // no //// {days-ago?}

// # API
    Route::any("/api/v1/{class}/{path?}", function ($class, $path) {
        return "{$class}/{$path} class: $class, path: $path";
    })->where('path', '.+')->name('api.allEndPoints'); // http://127.0.0.1:8000/api/v1/post/dev/admin
    // Route::any("api/v1/{class}/{path?}", [GlobalAPIController::class, 'parseRequest'])->where('path', '.+');

    // automatic conversion to JSON
        // * page to application/json
    Route::any("/api", function () {
        return ['foo' => 'bar'];
    })->name('api.apiToJson'); // http://127.0.0.1:8000/api/ // view in Firefox, to get additional information - application/json

    // explicit conversion to JSON
        // page returns html JSON
    Route::any("/api/2", function () {
        return json_encode(['foo2' => 'bar2']);
    })->name('api.apiToJson2'); // http://127.0.0.1:8000/api/2

// # with views
    // Route::get('/', function () {
    //     return view('welcome');
    // })->name('home.index'); // http://127.0.0.1:8000/
    // or
    Route::view('/', 'welcome')->name('home.index'); // http://127.0.0.1:8000/

    // view nested in a folder
    Route::get('/dashboard', function () {
        return view('home.dashboard', );
    })->name('home.dashBoard'); // http://127.0.0.1:8000/dashboard

    Route::get('/greenbox', function () {
        return view('tests.greenbox');
    })->name('home.greenbox'); // http://127.0.0.1:8000/greenbox

    Route::get('/posts', function () {
        $posts = [
            1 => [
                'title' => 'Intro to Laravel',
                'content' => 'This is a short intro to Laravel'
            ],
            2 => [
                'title' => 'Intro to PHP',
                'content' => 'This is a short intro to PHP'
            ]
        ];
        
        return view('posts.posts', ['posts' => $posts]);
    })->name('post.posts'); // http://127.0.0.1:8000/posts

    // * wildcard
    Route::get('/post/{id}', function ($id) {
        $posts = [
            1 => [
                'title' => 'Intro to Laravel',
                'content' => 'This is a short intro to Laravel'
            ],
            2 => [
                'title' => 'Intro to PHP',
                'content' => 'This is a short intro to PHP'
            ]
        ];

        abort_if(!isset($posts[$id]), 404);

        return  view('posts.post', ['post' => $posts[$id], 'id' => $id]);
    })->name('post.post'); // http://127.0.0.1:8000/post/1

// # with views & controller
    Route::get('/postdb/{slug}', [PostsController::class, 'show'])->name('post.postdb'); // http://127.0.0.1:8000/postdb/my-first-post
    
    Route::get('/postsdb', [PostsController::class, 'index'])->name('post.postsdb'); // http://127.0.0.1:8000/postsdb