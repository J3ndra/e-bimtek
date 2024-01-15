<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/', 'HomeController@redirect');
    Route::get('home', 'HomeController@index')->name('home');

    // Data Admin
    Route::resource('admins', 'AdminController');

    // Data Category
    Route::resource('categories', 'CategoryController');

    // Data Team
    Route::resource('teams', 'TeamController');

    // Certificate Designs
    Route::resource('designs', 'DesignController');
    Route::post('design/edit/{id}', 'DesignController@updatem')->name('designs.updatem');
    Route::post('design/edit/font/{id}', 'DesignController@updatefont')->name('designs.updatefont');
    Route::post('design/datas', 'DesignController@datas')->name('design.datas');

    // Data User
    Route::resource('users', 'UserController');
    Route::post('users/score/{id?}', 'UserController@score')->name('users.score');
    Route::get('users/score/detail/{id?}', 'UserController@detail')->name('users.score.detail');

    // Data Channel
    Route::resource('channels', 'ChannelController')->except(['create', 'store', 'destroy']);
    Route::post('channels/sync', 'ChannelController@sync')->name('channels.sync');

    // Data Page
    Route::resource('pages', 'PageController');

    // Data Setting
    Route::resource('settings', 'SettingController');

    // Data Course
    Route::resource('courses', 'CourseController')->except('show', 'destroy');
    Route::get('courses/{id}/destroy', 'CourseController@destroy')->name('courses.destroy');

    // Data Slider
    Route::resource('sliders', 'SliderController');

    Route::prefix('courses/{course}/lessons')->group(function () {
        // Lessons
        Route::name('lessons.')->group(function () {
            Route::get('create', 'LessonController@create')->name('create');
            Route::post('store', 'LessonController@store')->name('store');
            Route::get('{id}/edit', 'LessonController@edit')->name('edit');
            Route::patch('{id}', 'LessonController@update')->name('update');
            Route::get('{id}/destroy', 'LessonController@destroy')->name('destroy');
        });

        // Sub Lessons
        Route::name('sublessons.')->prefix('{lessons}/sub')->group(function () {
            Route::get('create', 'SubLessonController@create')->name('create');
            Route::post('store', 'SubLessonController@store')->name('store');
            Route::get('{id}/edit', 'SubLessonController@edit')->name('edit');
            Route::patch('{id}', 'SubLessonController@update')->name('update');
            Route::get('{id}/destroy', 'SubLessonController@destroy')->name('destroy');
        });
    });

    // Data Quiz
    Route::resource('quizzes', 'QuizController');

    Route::name('questions.')->prefix('quizzes/{quiz}/questions')->group(function () {
        Route::get('create', 'QuestionController@create')->name('create');
        Route::post('store', 'QuestionController@store')->name('store');
        Route::get('{id}/edit', 'QuestionController@edit')->name('edit');
        Route::patch('{id}', 'QuestionController@update')->name('update');
        Route::delete('{id}', 'QuestionController@destroy')->name('destroy');
    });

    // Payment
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/{type?}', 'PaymentController@index')->name('index');
        Route::get('show/{id}', 'PaymentController@show')->name('show');
        Route::patch('{id}/approve', 'PaymentController@approve')->name('approve');
        Route::patch('{id}/reject', 'PaymentController@reject')->name('reject');
    });

    // Account
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', 'AccountController@index')->name('index');
        Route::patch('update', 'AccountController@update')->name('update');
        Route::get('password', 'AccountController@password')->name('password');
        Route::patch('password', 'AccountController@updatePassword');
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', 'ReportController@index')->name('index');
        Route::post('{date}/view', 'ReportController@view')->name('view');
        Route::post('{date}/download', 'ReportController@download')->name('download');
    });
});
