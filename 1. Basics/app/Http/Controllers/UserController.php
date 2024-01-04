<?php

// php artisan make:controller UserController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // return view('user.profile', [
        //     'user' => User::findOrFail($id)
        // ])

        return User::findOrFail($id);
    }

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Controller Middlewares
        $this->middleware('auth');
        $this->middleware('isValid');
    }
}
