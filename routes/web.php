<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
  //Grab all the files for the blog posts
  return view('posts',[
    'posts' => Post::all()
  ]);

});

// //The wildcard {post} is converted into $slug
// Route::get('posts/{post}', function ($slug) {

//   return view('post',[
//     //Pass $slug to the Postclass to find the relevant file
//     'post' => Post::findOrFail($slug)
//   ]);

// });

Route::get('posts/{post}', function ($id) {

  return view('post',[
    //Pass $slug to the Postclass to find the relevant file
    'post' => Post::findOrFail($id)
  ]);

});