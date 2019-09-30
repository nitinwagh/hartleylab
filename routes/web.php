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

Route::get('/', 'ContactController@index');

Auth::routes(['verify' => true]);

Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::get('/contacts/add', 'ContactController@add')->name('contact-add');
Route::post('/contacts/store', 'ContactController@store')->name('contact-store');
Route::get('/contacts/show/{id}', 'ContactController@show')->name('contact-show');
Route::get('/contacts/share/{id}', 'ContactController@shareForm')->name('contact-show-share');
Route::post('/contacts/share', 'ContactController@share')->name('contact-share');
Route::get('/contacts/edit/{id}', 'ContactController@edit')->name('contact-edit');
Route::post('/contacts/update/{id}', 'ContactController@update')->name('contact-update');
Route::post('/contacts/delete', 'ContactController@destroy')->name('contact-delete');
