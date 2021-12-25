<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\StudentController;
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

// students 學生
Route::get('students/export/', [StudentController::class, 'export'])->name('students.export');
Route::get('students/export_phones/', [StudentController::class, 'export_phones'])->name('phones.export');

Route::get('/create-file', [StudentController::class, 'createFile'])->name('students.create-file');
Route::post('/store-file', [StudentController::class, 'storeFile'])->name('students.store-file');

Route::resource('students', StudentController::class);
Route::get('students.page/{page}',[StudentController::class, 'show'])->name('students.page');

// cars 車子(物件導向)
Route::resource('cars', CarController::class);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');




    

