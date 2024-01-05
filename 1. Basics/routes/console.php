<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// php artisan hello
Artisan::command('hello', function () {
    $this->info('Hello World!');
});

// php artisan msg:send 2
Artisan::command('msg:send {user}', function ($user) {
    $this->info("Sending message to the user having ID: {$user}!");
})->purpose('Send a marketing message to a user');
