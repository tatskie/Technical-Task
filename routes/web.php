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

Route::resource('/exam', 'ExamController');
Route::resource('/questions', 'QuestionController');
Route::get('/question-options/{id}', 'QuestionController@questionOptions');
Route::get('/options/{id}', 'OptionController@show')->name('options.show');
Route::patch('/options/{id}', 'OptionController@update')->name('options.update');
// Route::get('/exam', function () {
// 	echo 'exam';
// })->name('exam');
