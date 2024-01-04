<?php

// php artisan make:controller PhotoController --resource
// php artisan make:controller PhotoController --model=Photo --resource (specifying the resource model)
// php artisan make:controller PhotoController --model=Photo --resource --requests (generating form requests for storage & update methods)
// php artisan make:controller PhotoController --api (API resource controller)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Method -> GET, URI -> /photos, Action -> index, Route Name -> photos.index
        return 'All the photos will be displayed here';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Method -> GET, URI -> /photos/create, Action -> create, Route Name -> photos.create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Method -> POST, URI -> /photos, Action -> store, Route Name -> photos.store
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Method -> GET, URI -> /photos/{photo}, Action -> show, Route Name -> photos.show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Method -> GET, URI -> /photos/{photo}/edit, Action -> edit, Route Name -> photos.edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Method -> Put/Patch, URI -> /photos/{photo}, Action -> update, Route Name -> photos.update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Method -> Delete, URI -> /photos/{photo}, Action -> destroy, Route Name -> photos.destroy
    }
}
