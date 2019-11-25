<?php

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
// Route::get('/factory', function () {
//     factory(App\Main::class, 5)->create();
//     echo 'комменты добавлены';
// });

Route::middleware(['admin'])->group(function () {
    //Admin
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin', 'AdminController@edit');
});
Route::middleware(['auth'])->group(function () {
    //Main
    Route::post('/', 'MainController@addComment');
    //User
    Route::get('/profile', 'ProfileController@index');
    Route::post('/edit', 'ProfileController@edit');
    Route::post('/edit_password', 'ProfileController@editPassword');
    Route::get('/logout', 'ProfileController@logout');
});
Route::middleware(['guest'])->group(function () {
    //User
    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@register');
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login');
});
//Main
Route::get('/', 'MainController@index');
