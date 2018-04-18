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

//Index
Route::get('/', 'PagesController@index');

//Resources
Route::resource('posts', 'PostsController');
Route::resource('answers', 'AnswersController');
Auth::routes();

//Dashboard
Route::get('/dashboard', 'DashboardController@index');  
Auth::routes();

//Home
Route::get('/home', 'HomeController@index')->name('home');

//Answers
Route::delete('/answers/{answer}/{post}', 'AnswersController@destroy');
Route::get('/answers/create/{post}', 'AnswersController@create');
Route::get('/answers/edit/{post}/{answer}', 'AnswersController@edit');

//Followers
Route::get('/followers/create/{user}', 'FollowersController@create');
Route::post('/followers/store/', 'FollowersController@store');
Route::get('/followers/{follower}/', 'FollowersController@show');
Route::delete('/followers/{follower}/{post}', 'FollowersController@delete');