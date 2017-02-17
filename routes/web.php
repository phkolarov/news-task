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

Route::get('/', 'HomeController@index')->name('public-page');
Route::get('/article/{id}', 'ArticleController@article')->name('current-article');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('administrator');
Route::get('/admin/article-administration', 'AdminController@articleAdministration')->name('article-administration');
Route::get('/admin/add-article', 'AdminController@addArticle')->name('add-article');
Route::post('/admin/adding-new-article', 'AdminController@addingNewArticle')->name('adding-new-article');
Route::post('/admin/deleteArticle', 'AdminController@deleteArticle')->name('delete-article');
Route::get('/admin/editArticle/{id}', 'AdminController@editArticle')->name('edit-article');
Route::post('/admin/editingArticle/{id}', 'AdminController@editingArticle')->name('editing-article');