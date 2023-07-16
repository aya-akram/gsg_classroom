<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\TopicsController;
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
})->name('home');
// Route::get('/classrooms','App\Http\Controllers\ClassroomsController@index');
// Route::get('/classrooms',[ClassroomsController::class,'index'])->name('classrooms.index');
// Route::get('/classrooms/create',[ClassroomsController::class,'create'])->name('classrooms.create');
// Route::post('/classrooms',[ClassroomsController::class,'store'])->name('classrooms.store');

// // Route::get('/classrooms/edit/{id}',[ClassroomsController::class,'edit'])->name('classrooms.edit');

// Route::get('/classrooms/{classroom}',[ClassroomsController::class,'show'])->name('classrooms.show')
//     ->where([
//         'classroom' => '\d+',
//     ]);
//     // ->where('edit','yes|no');

//     Route::get('/classrooms/{classroom}/edit',[ClassroomsController::class,'edit'])->name('classrooms.edit')
//     ->where('classroom','\d+');

//     Route::put('/classrooms/{classroom}',[ClassroomsController::class,'update'])->name('classrooms.update')
//     ->where('classroom','\d+');

//     Route::delete('/classrooms/{classroom}',[ClassroomsController::class,'destroy'])->name('classrooms.destroy')
//     ->where('classroom','\d+');
    // Route::resource('/classrooms', ClassroomsController::class)
    // ->names([
    // // 'inadex' => 'classrooms/index',
    // // 'create' => 'classrooms/create',
    // ])
    // ->where([
    //     'classrooms' => '\d+'
    // ]);


    Route::get('/topics',[TopicsController::class,'index'])->name('topics.index');
Route::get('/topics/create',[TopicsController::class,'create'])->name('topics.create');
Route::post('/topics',[TopicsController::class,'store'])->name('topics.store');
Route::get('/classrooms/topics/{topics}',[TopicsController::class,'show'])->name('topics.show');
Route::get('/{topics}/edit',[TopicsController::class,'edit'])->name('topics.edit');
 Route::put('topic/{topics}/update',[TopicsController::class,'update'])->name('topics.update');
    Route::delete('topic/{topics}',[TopicsController::class,'destroy'])->name('topics.destroy');

Route::resources([
    'classrooms' => ClassroomsController::class
]);
