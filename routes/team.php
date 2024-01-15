<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Team Routes
|--------------------------------------------------------------------------
|
| Here is where you can register team routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "team" middleware group. Now create something great!
|
*/

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::middleware('auth:team')->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@redirect');

    Route::resource('courses', 'CourseController')->only('index', 'edit', 'update', 'destroy');

    Route::prefix('courses/{course}/lessons')->group(function() {
        Route::name('lessons.')->group(function() {
            Route::get('create', 'LessonController@create')->name('create');
            Route::post('store', 'LessonController@store')->name('store');
            Route::get('{id}/edit', 'LessonController@edit')->name('edit');
            Route::patch('{id}', 'LessonController@update')->name('update');
            Route::get('{id}/destroy', 'LessonController@destroy')->name('destroy');
        });

        Route::name('sublessons.')->prefix('{lessons}/sub')->group(function() {
            Route::get('create', 'SubLessonController@create')->name('create');
            Route::post('store', 'SubLessonController@store')->name('store');
            Route::get('{id}/edit', 'SubLessonController@edit')->name('edit');
            Route::patch('{id}', 'SubLessonController@update')->name('update');
            Route::get('{id}/destroy', 'SubLessonController@destroy')->name('destroy');
        });
    });

    Route::resource('quizzes', 'QuizController');

    Route::name('questions.')->prefix('quizzes/{quiz}/questions')->group(function() {
        Route::get('create', 'QuestionController@create')->name('create');
        Route::post('store', 'QuestionController@store')->name('store');
        Route::get('{id}/edit', 'QuestionController@edit')->name('edit');
        Route::patch('{id}', 'QuestionController@update')->name('update');
        Route::delete('{id}', 'QuestionController@destroy')->name('destroy');
    });

    Route::prefix('account')->name('account.')->group(function() {
        Route::get('/', 'AccountController@index')->name('index');
        Route::patch('update', 'AccountController@update')->name('update');
        Route::get('password', 'AccountController@password')->name('password');
        Route::patch('password', 'AccountController@updatePassword');
    });
});
