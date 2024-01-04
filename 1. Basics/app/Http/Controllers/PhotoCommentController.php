<?php

// php artisan make:controller PhotoCommentController --resource

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Shallow Nested Resources (photos.comments)
class PhotoCommentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Method -> GET, URI -> /photos/{photo}/comments
    // Action -> index, Route Name -> photos.comments.index
    return 'All the comments on this photo will be displayed here';
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // Method -> GET, URI -> /photos/{photo}/comments/create
    // Action -> create, Route Name -> photos.comments.create
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Method -> POST, URI -> /photos/{photo}/comments
    // Action -> store, Route Name -> photos.comments.store
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // Method -> GET, URI -> /comments/{comment}
    // Action -> show, Route Name -> comments.show
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    // Method -> GET, URI -> /comments/{comment}/edit
    // Action -> edit, Route Name -> comments.edit
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
    // Method -> Put/Patch, URI -> /comments/{comment}
    // Action -> update, Route Name -> comments.update
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // Method -> Delete, URI -> /comments/{comment}
    // Action -> destroy, Route Name -> comments.destroy
  }
}
