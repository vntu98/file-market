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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin'], function () {
    Route::get('', 'AdminController@index')->name('admin.index');

    Route::prefix('files')->group(function () {
        Route::prefix('new')->group(function () {
            Route::get('', 'FileNewController@index')->name('admin.files.new.index');
            Route::post('{file}', 'FileNewController@update')->name('admin.files.new.update');
            Route::delete('{file}', 'FileNewController@destroy')->name('admin.files.new.destroy');
        });

        Route::prefix('updated')->group(function () {
            Route::get('', 'FileUpdatedController@index')->name('admin.files.updated.index');
            Route::patch('{file}', 'FileUpdatedController@update')->name('admin.files.updated.update');
            Route::delete('{file}', 'FileUpdatedController@destroy')->name('admin.files.updated.destroy');
        });
    });
});

Route::post('{file}/upload', 'Upload\UploadController@store')->name('upload.store');
Route::delete('{file}/upload/{upload}', 'Upload\UploadController@destroy')->name('upload.destroy');
