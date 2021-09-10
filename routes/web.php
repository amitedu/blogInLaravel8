<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

//Route::get('/categories/{category:slug}', function (Category $category) {
////    Eager loading can be this way
////    return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);
//    return view('posts', [
//        'posts' => $category->posts,
//        'currentCategory' => $category,
//        'categories' => Category::all()
//    ]);
//})->name('categories');

Route::get('/author/{author:username}', function (User $author) {
//    Eager loading can be this way or mention in the model
//    return view('posts', ['posts' => $author->posts->load(['category', 'author'])]);
    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});
