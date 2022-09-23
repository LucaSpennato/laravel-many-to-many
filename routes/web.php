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
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('admin.home');
// });



Auth::routes();

// ! E' possibile usare l'auth anche dalle rotte in questo modo, vedi anche in HomeController!
//  * Route::middleware('auth')->get('/home', 'Admin\HomeController@index')->name('home');

// ? è possibile anche unire le rotte in questo modo: 
// ? proteggo tutte le rotte con il middleware, se provo ad accedere da non loggato verrò portato al login!
Route::middleware('auth')
    // ? aggiorna le cartelle all'interno della quale si trovano i controller 
    ->namespace('Admin')
    // ? aggiorna i name delle sottorotte con il prefisso admin.
    ->name('admin.')
    // ? aggiorna ogni url con il prefisso /admin
    ->prefix('admin')
    // ? raggruppa le varie rotte
    ->group(function(){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/users', 'UserController');
        Route::resource('/posts', 'PostController');
        Route::resource('/tags', 'TagController');
    });
    

