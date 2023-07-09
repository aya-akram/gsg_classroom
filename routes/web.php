<?php

use App\Http\Controllers\ClassroomsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/classrooms','App\Http\Controllers\ClassroomsController@index');
Route::get('/classrooms',[ClassroomsController::class,'index'])->name('classrooms.index');
Route::get('/classrooms/create',[ClassroomsController::class,'create'])->name('classrooms.create');


Route::get('/classrooms/edit/{id}',[ClassroomsController::class,'edit'])->name('classrooms.edit');

Route::get('/classrooms/{id}/{edit?}',[ClassroomsController::class,'show'])->name('classrooms.show')
    ->where('classroom','.+')
    ->where('edit','yes|no');
