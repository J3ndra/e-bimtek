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

Auth::routes(['verify' => true]);

Route::get('/', 'FrontController@home')->name('home');
Route::get('page/{slug}', 'FrontController@page')->name('page');
Route::get('category/{name}', 'FrontController@category')->name('category');
Route::get('courses', 'CourseController@courses')->name('courses');
Route::get('course/{slug}', 'CourseController@course')->name('course');
Route::post('callback', 'CallbackController@callback')->name('callback');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'FrontController@dashboard')->name('dashboard');

    Route::get('certificate', 'CertificateController@index')->name('certificate.index');
    Route::post('course/{slug}/{method}/pay', 'CourseController@pay')->name('course.pay');
    Route::get('payment/{code}', 'CourseController@paymentDetail')->name('payment.detail');
    Route::get('course/{slug}/{lesson}/{subLesson}', 'CourseController@subLesson')->name('sublesson');
    Route::post('course/{slug}/certificate', 'CourseController@certificate')->name('certificate');
    Route::post('course/{slug}/feedback', 'CourseController@feedback')->name('feedback');

    Route::prefix('quiz/{quiz}')->name('quiz.')->group(function () {
        Route::post('start', 'QuizController@start')->name('start');
        Route::get('question/{id}', 'QuizController@question')->name('question');
        Route::patch('question/{id}', 'QuizController@answer')->name('answer');
        Route::post('finish', 'QuizController@finish')->name('finish');
        Route::get('score', 'QuizController@score')->name('score');
    });

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', 'AccountController@index')->name('index');
        Route::patch('update', 'AccountController@update')->name('update');
        Route::get('password', 'AccountController@password')->name('password');
        Route::patch('password', 'AccountController@updatePassword');
    });
});
