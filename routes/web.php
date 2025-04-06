<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    StudentController,
    MarksController,
    ResultController,
    UserController,
    FeesReceiptController,
    ExcellenceController
};

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
Auth::routes();
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::middleware(['auth','password.confirm'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('admin')->group(function () {

        Route::controller(StudentController::class)->group(function () {
            Route::get('students', 'student')->name('student');
            Route::get('students/create', 'create')->name('create-student');
            Route::post('students/store', 'store')->name('store-student');
            Route::get('students/edit/{id}', 'edit')->name('edit-student');
            Route::put('students/update/{id}', 'update')->name('update-student');
            Route::get('students/view/{id}', 'show')->name('view-student');
            Route::get('students/delete/{id}', 'destroy')->name('delete-student');
            Route::post('/student-ajax', 'fetchStudents')->name('student-ajax');

        });

        Route::controller(MarksController::class)->group(function () {
            Route::get('marks', 'index')->name('mark');
            Route::get('marks/add', 'create')->name('addmarks');
            Route::post('marks/store', 'store')->name('store-marks');
            Route::get('marks/edit/{id}', 'edit')->name('edit-marks');
            Route::put('marks/update/{id}', 'update')->name('update-marks');
            Route::get('marks/delete/{id}', 'destroy')->name('delete-marks');
            Route::get('co-scholastic', 'coscholastic')->name('co-scholastic');
        });

        Route::controller(ExcellenceController::class)->group(function () {
            Route::get('excellence', 'index')->name('excellence');
            Route::get('excellence/add', 'create')->name('create.excellence');
            Route::post('excellence/store', 'store')->name('store.excellence');
            Route::get('excellence/edit/{id}', 'edit')->name('edit.excellence');
            Route::put('excellence/update/{id}', 'update')->name('update.excellence');
            Route::get('excellence/delete/{id}', 'destroy')->name('destroy.excellence');
        });

        Route::controller(ResultController::class)->group(function () {
            Route::get('results', 'index')->name('result');
            Route::get('prints-results', 'view')->name('view-result');
            Route::post('generate-results', 'generateResult')->name('generate-result');
            Route::get('results/create', 'create')->name('create-result');
            Route::post('results/store', 'store')->name('store-result');
            Route::get('results/edit/{id}', 'edit')->name('edit-result');
            Route::put('results/update/{id}', 'update')->name('update-result');
            Route::get('results/view/{id}', 'show')->name('show-result');
            Route::get('results/delete/{id}', 'destroy')->name('delete-result');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index')->name('index');
            Route::get('users/add', 'create')->name('adduser');
            Route::post('users/store', 'store')->name('store');
            Route::get('users/edit/{id}', 'edit')->name('edit');
            Route::put('users/update/{id}', 'update')->name('update');
            Route::get('users/view/{id}', 'view')->name('view');
            Route::get('users/delete/{id}', 'destroy')->name('delete');
            Route::get('profile/{id}', 'profile')->name('profile');
            Route::put('profile/{id}', 'profileUpdate')->name('profileUpdate');
        });

        Route::controller(FeesReceiptController::class)->group(function () {
            Route::get('receipts/create', 'receiptCreate')->name('fees-receipt.create');
            Route::get('receipts', 'receiptIndex')->name('receipts.index');
            Route::post('receipts/store', 'generateReceipt')->name('receipts.store');
            Route::get('receipts/edit/{id}', 'receiptEdit')->name('receipts.edit');
            Route::put('receipts/update/{id}', 'updateReceipt')->name('receipts.update');
            Route::get('receipts/download/{id}', 'downloadReceipt')->name('download-receipt');
            Route::get('receipts/delete/{id}', 'deleteReceipt')->name('delete-receipt');
            Route::get('receipts/show/{id}', 'showReceipt')->name('show-receipt');
            Route::get('/student-fees/{id}', 'getStudentFees')->name('student.fees');
        });
    });
});
