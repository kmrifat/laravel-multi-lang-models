<?php

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

Route::get('/', function () {
    return view('welcome', [
        'blogs' => \App\Blog::orderBy('id', 'desc')->paginate(20)
    ]);
});

Route::get('/read-blog/{id}', function ($id) {
    return view('blog-read', [
        'blog' => \App\Blog::findOrFail($id)
    ]);
})->name('read-blog');

Route::get('/change-lang/{lang}', 'LanguageController@changeLang')->name('change-lang');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('blog', 'BlogController');
