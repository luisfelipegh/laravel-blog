<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

/* Admin routes */
Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
    ->middleware('auth')
    ->group(base_path('routes/admin/web.php'));

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'BlogController@index')->name('home');
Route::get('/' . config('routing.categories') .'/{category}', 'BlogController@category')->name('category');
Route::get('/' . config('routing.posts') . '/{title}', 'PostController@read')->name('posts');
Route::get('/' . config('routing.pages') . '/{title}', 'PageController@read')->name('pages');

Route::get('/ads.txt', function () {
    return file_get_contents(base_path('ads.txt'));
});

Route::get(config('routing.contact'), 'ContactController@create')->name('contact.create');
Route::post(config('routing.contact'), 'ContactController@store')->name('contact.store');
