<?php

use Illuminate\Support\Facades\Route;
use \App\Models\Posts;

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

Route::get('/', function () {
    $posts = Posts::all();
    return view('posts',[
        'posts'=>$posts
    ]);
});
Route::get('posts/{name}', function ($name) {
    $post = Posts::findOrFail($name);
    return view('post',[
        'post'=>$post
    ]);
});
