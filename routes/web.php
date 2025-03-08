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
    return view('auth.login');
});
Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/student', [App\Http\Controllers\studentController::class, 'student'])->name('student');
Route::get('/create-student', [App\Http\Controllers\studentController::class, 'create'])->name('create-student');
Route::post('/store-student', [App\Http\Controllers\studentController::class, 'store'])->name('store-student');
Route::get('/edit-student/{id}', [App\Http\Controllers\studentController::class, 'edit'])->name('edit-student');
Route::put('/update-student/{id}', [App\Http\Controllers\studentController::class, 'update'])->name('update-student');
Route::get('/view-student/{id}', [App\Http\Controllers\studentController::class, 'show'])->name('view-student');
Route::get('/delete-student/{id}', [App\Http\Controllers\studentController::class, 'destroy'])->name('delete-student');

Route::get('/mark', [App\Http\Controllers\MarkController::class, 'index'])->name('mark');
Route::get('/addmarks', [App\Http\Controllers\MarkController::class, 'create'])->name('addmarks');
Route::post('/store-marks', [App\Http\Controllers\MarkController::class, 'store'])->name('store-marks');

Route::get('/co-scholastic', [App\Http\Controllers\MarkController::class, 'coscholastic'])->name('co-scholastic');

Route::get('/result', [App\Http\Controllers\resultController::class, 'index'])->name('result');
Route::get('/create-result', [App\Http\Controllers\resultController::class, 'create'])->name('create-result');
Route::post('/store-result', [App\Http\Controllers\resultController::class, 'store'])->name('store-result');
Route::get('/edit-result/{id}', [App\Http\Controllers\resultController::class, 'edit'])->name('edit-result');
Route::put('/update-result/{id}', [App\Http\Controllers\resultController::class, 'update'])->name('update-result');
Route::get('/view-result/{id}', [App\Http\Controllers\resultController::class, 'show'])->name('view-result');
Route::get('/delete-result/{id}', [App\Http\Controllers\resultController::class, 'destroy'])->name('delete-result');

Route::get('/adduser', [App\Http\Controllers\UserController::class, 'create'])->name('adduser');
Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
Route::get('/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('view');
Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delete');








