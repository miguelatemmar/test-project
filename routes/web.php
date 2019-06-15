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

Route::get('/', function () { return view('welcome');});

// assignments crud
Route::resource('/assignments', 'AssignmentsController');
Route::get('/assignments/create', 'AssignmentsController@create');
Route::get('/assignments/{assignment}', 'AssignmentsController@show');
Route::get('/assignments/{assignment}/edit', 'AssignmentsController@edit');
Route::patch('/assignments/{assignment}', 'AssignmentsController@update');
Route::delete('/assignments/{assignment}', 'AssignmentsController@destroy');
Route::post('/assignments', 'AssignmentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
