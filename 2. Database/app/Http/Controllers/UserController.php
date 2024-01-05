<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* ---------- SELECT ---------- */

        $users = DB::select('select * from users');
        // $user = DB::select('select * from users where name = ?', ["john"])
        // $results = DB::select('select * from users where id = :id', ['id' => 1])

        foreach ($users as $user) {
            echo $user->name . ": " . $user->email . "<br>";
        }


        /* ---------- INSERT ---------- */

        // DB::insert('insert into users (id, name, email, password) values (?, ?, ?, ?)', [5, 'Marc', 'marc@gmail.com', '15824sdsdfsdff'])


        /* ---------- UPDATE ---------- */

        $affected = DB::update(
            'update users set email = "marc10@gmail.com" where name = ?',
            ['Marc']
        );


        /* ---------- DELETE ---------- */

        $deleted = DB::delete('delete from users where name = ?', ["jade"]);


        /* ---------- STATEMENT ---------- */

        // DB::statement('drop table posts')


        // Using Multiple Database Connections
        // $users = DB::connection('sqlite')->select(/* ... */)


        /* ---------- TRANSACTION ---------- */

        DB::transaction(function () {
            DB::update(
                'update users set email = "marc10@gmail.com" where name = ?',
                ['Marc']
            );

            DB::delete('delete from users where name = ?', ["jade"]);
        });
    }
}
