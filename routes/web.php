<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProjectsController;
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
    Route::any("/api/2", function () {
        return response()->json(['foo2' => 'bar2']);
    })->name('api.apiToJson2'); // http://127.0.0.1:8000/api/2
        // page returns html JSON
    Route::any("/api/3", function () {
        return json_encode(['foo3' => 'bar3']);
    })->name('api.apiToJson3'); // http://127.0.0.1:8000/api/3

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

    // Route::get('/posts', function () {
    //     $posts = [
    //         1 => [
    //             'title' => 'Intro to Laravel',
    //             'content' => 'This is a short intro to Laravel'
    //         ],
    //         2 => [
    //             'title' => 'Intro to PHP',
    //             'content' => 'This is a short intro to PHP'
    //         ]
    //     ];
        
    //     return view('posts.posts', ['posts' => $posts]);
    // })->name('post.posts'); // http://127.0.0.1:8000/posts

    $posts = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel'
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP'
        ]
    ]; // to use in closure = use($posts)

    Route::get('/posts', function () use($posts) {
        return view('posts.posts', ['posts' => $posts]);
    })->name('post.posts'); // http://127.0.0.1:8000/posts

    // * wildcard
    Route::get('/post/{id}', function ($id) use($posts) {

        abort_if(!isset($posts[$id]), 404);

        return  view('posts.post', ['post' => $posts[$id], 'id' => $id]);
    })->name('post.post'); // http://127.0.0.1:8000/post/1

// # with views & controller
    Route::get('/postdb/{slug}', [PostsController::class, 'show'])->name('post.postdb'); // http://127.0.0.1:8000/postdb/my-first-post
    
    Route::get('/postsdb', [PostsController::class, 'index'])->name('post.postsdb'); // http://127.0.0.1:8000/postsdb
    Route::get('/postsdb', [PostsController::class, 'index'])->name('post.postsdb'); // http://127.0.0.1:8000/postsdb

// # others
    // * gouping
    Route::prefix('/fun')->name('fun.')->group(function () {
        // * redirect
        Route::get('/redirect', function () {
            return redirect('/postsdb');
        })->name('redirect'); // http://127.0.0.1:8000/fun/redirect
        Route::get('/back', function () {
            return back();
        })->name('back'); // http://127.0.0.1:8000/fun/back
        Route::get('/route-name', function () {
            return redirect()->route('post.postsdb');
        })->name('routeName'); // http://127.0.0.1:8000/fun/route-name
        Route::get('/away', function () {
            return redirect()->away('https://mooredigitalsolutions.com/');
        })->name('away'); // http://127.0.0.1:8000/fun/away
    
        // * down load
        Route::any("/download", function () {
            return response()->download(public_path('/images/2019-11-09_10-14-52.png'), 'file-renamed.png');
        })->name('download'); // http://127.0.0.1:8000/fun/download
    });

// # resource path
    // * I have lots of different queries/examples in the commands.js file
    Route::resource('projects', ProjectsController::class); // php artisan route:list
    // Route::resource('projects', ProjectsController::class)->only(['index', 'show']);
    // Route::resource('projects', ProjectsController::class)->except(['index', 'show']);

// # parameters
    Route::get('/parameters/{class}/{path?}', function () {
        dd(
            request(), 
            request()->all(), 
            request('page'), 
            (int) request()->input('page', 1),
            request()->query(),
            request()->url(),
            request()->post(),
            request()->fullUrl(),
            request()->class,
            url()->full(),
            request()->path,
            app()
        );
        // others
        // ? https://www.udemy.com/course/laravel-beginner-fundamentals/learn/lecture/23329440#questions
        // request()->input('page', default)
    })->where('path', '.+')->name('parameters'); // http://127.0.0.1:8000/parameters/posts/dev/greenman?page=3&perpage=40

