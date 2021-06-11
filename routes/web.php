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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'namespace' => 'Account'], function () {
    Route::get('', 'AccountController@index')->name('account');

    Route::prefix('files')->group(function () {
        Route::get('', 'FileController@index')->name('account.files.index');
        Route::get('{file}/edit', 'FileController@edit')->name('account.files.edit');
        Route::post('{file}/update', 'FileController@update')->name('account.files.update');
        Route::post('', 'FileController@store')->name('account.files.store');
        Route::get('create', 'FileController@create')->name('account.files.create.start');
        Route::get('{file}/create', 'FileController@create')->name('account.files.create');
    });
});
