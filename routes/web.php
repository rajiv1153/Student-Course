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

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::prefix('course')->group(function () {
    Route::POST('/store', [App\Http\Controllers\CourseController::class, 'store'])->name('course.store');
    Route::get('/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('course.delete');
    Route::POST('/add', [App\Http\Controllers\CourseController::class, 'add'])->name('course.add');
    Route::get('/remove/{id}', [App\Http\Controllers\CourseController::class, 'remove'])->name('course.remove');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

