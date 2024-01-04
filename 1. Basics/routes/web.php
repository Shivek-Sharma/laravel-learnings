<?php

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

// php artisan route:list (list all the routes)
// php artisan route:cache (execute only after defining all the routes)
// php artisan route:clear (clears route cache)

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello World!';
});

// Route::redirect('/hi', '/hello') // returns 302 default status code
Route::redirect('/hi', '/hello', 301); // returns 301 status code

Route::view('/template', 'template'); // /resources/views/template.blade.php


/* ---------------------- Route Parameters ----------------------- */

// Route::get('/user/{id}', function ($id) {
//     return 'User ' . $id;
// })

Route::put('/blog/{id}', function ($id) {
    //
})->middleware('role:author');

// Order of route parameters matters, not the name
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Post ' . $postId . ' and Comment ' . $commentId;
});

// Default route parameter
Route::get('/region/{region?}', function ($region = 'Asia') {
    return $region;
});


/* ---------------------- Regex Constraints ----------------------- */

// Route::get('/user/{id}', function ($id) {
//     return 'User ' . $id;
// })->where('id', '[0-9]+')

// Route::get('/user/{id}/{name}', function ($id, $name) {
//     return 'User ' . $id . ' Name ' . $name;
// })->where(['id' => '[0-9]+', 'name' => '[a-z]+'])

Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'User ' . $id . ' Name ' . $name;
})->whereNumber('id')->whereAlpha('name');


/* ---------------------- Named Routes ----------------------- */

Route::get('/author/profile', function () {
    return 'This is profile page for blog author';
})->name('profile'); // route('profile')

// Route::get('/user/{id}/profile', function ($id) {
//     //
// })->name('profile')

Route::get('/user/login', function () {
    return 'This is user login page';
})->name('login'); // route('login')


/* ---------------------- Route Groups ----------------------- */

// Middleware are executed in the order they are listed in the array
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/dashboard', function () {
        // Uses first & second middleware...
    });

    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});


/*
use App\Http\Controllers\OrderController;

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
*/


// Subdomain Routing
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });

    Route::get('post/{id}', function ($account, $id) {
        //
    });
});

// Route Prefixes
Route::middleware('isValid')->prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches the "/admin/users" URL
        return 'This is users route for Admin';
    });

    // The 'withoutMiddleware' can only remove route middleware and does not apply to global middleware
    Route::get('/posts', function () {
        // Matches the "/admin/posts" URL
        return 'This is posts route for Admin';
    })->withoutMiddleware('isValid');
});

// Route Name Prefixes
Route::name('admin.')->group(function () {
    Route::get('/posts', function () {
        // Route assigned name "admin.users"
        return 'This is posts route for Admin';
    })->name('users');
});


/* ----------------- Route Model Binding ------------------ */

use App\Models\User;

// Implicit Binding
Route::get('/users/{user}', function (User $user) {
    return $user->email;
});

// Explicit Binding -> /app/Providers/RouteServiceProvider.php -> Route::model('user', User::class)
Route::get('/users/{user}', function (User $user) {
    return $user->email;
});


/* -------- Attaching Rate Limiters to Routes -------- */

// /app/Providers/RouteServiceProvider.php -> configureRateLimiting()
Route::middleware(['throttle:uploads'])->group(function () {
    Route::post('/audio', function () {
        //
    });

    Route::post('/video', function () {
        //
    });
});


/* ----------------- Fallback Routes ------------------ */

// The fallback route should always be the last route registered by your application
Route::fallback(function () {
    return '404! This route does not exist';
});
