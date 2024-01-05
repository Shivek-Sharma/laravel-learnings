<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}', [UserController::class, 'show']);

// When registering routes for single action controllers, you do not need to specify a controller method
Route::get('/sac', SingleActionController::class);

// Executing Commands outside of the CLI
Route::post('/user/{user}/mail', function ($user) {
    $exitCode = Artisan::call('mail:send', [
        'user' => $user, '--queue' => 'default'
    ]);

    // Queueing Artisan Commands
    Artisan::queue('mail:send', [
        'user' => $user, '--queue' => 'default'
    ])->onConnection('redis')->onQueue('commands');
});


/* ---------------- Resource Controllers -------------------- */

Route::resource('photos', PhotoController::class)
    ->missing(function (Request $request) {
        return Redirect::route('photos.index');
    });

// Route::resource([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ])


/* ---------------- Partial Resource Routes -------------------- */

Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
]);

Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);

// API Resource Routes (exclude routes that present HTML templates such as 'create' and 'edit')
Route::apiResource('photos', PhotoController::class);

// Route::apiResources([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ])


/* ---------------- Nested Resources -------------------- */

// To nest the resource controllers, you may use "dot" notation in your route declaration
// URIs will look like: /photos/{photo}/comments/{comment}
Route::resource('photos.comments', PhotoCommentController::class);

// Shallow Nesting (often not necessary to have both the parent and the child IDs within a URI)
Route::resource('photos.comments', PhotoCommentController::class)->shallow();


/* ---------------- Naming Resource Routes -------------------- */

// 'create' action => 'photos.create' changes to 'photos.build'
Route::resource('photos', PhotoController::class)->names([
    'create' => 'photos.build'
]);


/* ---------------- Singleton Resource Controllers -------------------- */

// "singleton resources", meaning one and only one instance of the resource may exist, like a user's profile
Route::singleton('profile', ProfileController::class);

// if you also want to register 'destroy' action for a singleton resource
Route::singleton('profile', ProfileController::class)->destroyable();

// Nested Singleton Resource (Only 'thumbnail' would be singleton resource)
Route::singleton('photos.thumbnail', ThumbnailController::class);

// API Singleton Resource (exclude 'create' and 'edit' actions)
Route::apiSingleton('profile', ProfileController::class);
