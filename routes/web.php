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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category', 'CategoryController@store')->name('category.store');
Route::get('/category', 'CategoryController@showCategoriesAndArticles')->name('category.all');


Route::get('/article/create', 'ArticleController@create')->name('article.create');
Route::post('/article', 'ArticleController@store')->name('article.store');
Route::get('/article/{slug}', 'ArticleController@show')->name('article.show');
