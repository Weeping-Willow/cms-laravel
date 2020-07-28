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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories','CategoriesController');
Route::resource('article','ArticleController');
Route::get('trashed-articles','ArticleController@trashed')->name('trashed-articles.index');
Route::put('restore-article/{article}','ArticleController@restore')->name('restore-articles');
