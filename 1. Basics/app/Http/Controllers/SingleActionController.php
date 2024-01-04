<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleActionController extends Controller
{
    /**
     * If a controller action is particularly complex,
     * you might find it convenient to dedicate an entire controller class to that single action.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return 'This is Single Action Controller';
    }
}
