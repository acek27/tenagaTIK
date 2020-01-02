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

//Route::get('/', function () {
//    return view('index');
//})->name('index');

Auth::routes();

Route::Resource('/', 'tenagaController');


Route::middleware(['auth', 'can:admin'])->group(function () {
//    Route::prefix('user')->group(function () {
//    });
    Route::resource('/home', 'adminController');
    Route::get('/tenaga/data', 'adminController@datatenaga')
        ->name('tenaga.data');
    Route::get('/biodata/{id}', 'adminController@biodata');
});
