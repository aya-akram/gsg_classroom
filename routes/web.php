<?php

use App\Http\Controllers\Admin\TwoFactorAuthenticationController;
use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\Webhooks\StripeController;
use App\Http\Middleware\ApplyUserPreferences;
use App\Models\Classroom;
use App\Models\Classwork;

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
Route::get('/admin/2fa',[TwoFactorAuthenticationController::class,'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:admin,web'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';

// Route::get('/topics',[TopicsController::class,'index'])->name('topics.index');
// Route::get('/topics/create',[TopicsController::class,'create'])->name('topics.create');
// Route::post('/topics',[TopicsController::class,'store'])->name('topics.store');
// Route::get('/classrooms/topics/{topics}',[TopicsController::class,'show'])->name('topics.show');
// Route::get('/{topics}/edit',[TopicsController::class,'edit'])->name('topics.edit');
//  Route::put('topic/{topics}/update',[TopicsController::class,'update'])->name('topics.update');
//     Route::delete('topic/{topics}',[TopicsController::class,'destroy'])->name('topics.destroy');

    // Route::get('/classrooms/{classroom}/topics');

    Route::get('/topics/trashed',[TopicsController::class,'trashed'])->name('topics.trashed');
    // Route::put('/classrooms/{classroom}/topics/{id}/restore', [TopicsController::class, 'restore'])->name('topics.restore');
    // Route::put('/topics/trashed/{topic}',[TopicsController::class,'restore'])->name('topics.restore');
    Route::put('/topics/trashed/{topic}',[TopicsController::class,'restore'])->name('topics.restore');

    Route::delete('/topics/trashed/{topic}',[TopicsController::class,'forceDelete'])->name('topics.forceDelete');
    Route::resource('classrooms.topics', TopicsController::class);

    // Route::group([
    //     'middleware' => ['auth'],
    // ],function(){
            // Shared routes
    // });

    Route::get('plans',[PlanController::class,'index'])->name('plans');

    Route::middleware(['auth:web,admin'])->group(function(){
        Route::get('subscriptions/{subscription}/pay',[PaymentsController::class,'create'])->name('checkout');
        Route::post('subscriptions',[SubscriptionController::class, 'store'])->name('subscriptions.store');
        Route::post('payments',[PaymentsController::class,'store'])->name('payments.store');
        Route::get('/payments/{subscription}/success',[PaymentsController::class,'success'])->name('payments.success');
        Route::get('/payments/{subscription}/cancel',[PaymentsController::class,'cancel'])->name('payments.cancel');

        Route::prefix('/classrooms/trashed')
        ->as('classrooms.')
        ->controller(ClassroomsController::class)
        ->group(function(){
            Route::get('/','trashed')->name('trashed');
            Route::put('/{classroom}','restore')->name('restore');
            Route::delete('/{classroom}','forceDelete')->name('force-delete');

        });
        Route::get('/classrooms/{classroom}/join',[JoinClassroomController::class,'create'])->name('classrooms.join');
        Route::post('/classrooms/{classroom}/join',[JoinClassroomController::class,'store']);
        Route::get('classrooms/{classroom}/chat',[ClassroomsController::class,'chat'])->name('classrooms.chat');
        Route::resources([
            'classrooms' => ClassroomsController::class,
        ]);
        Route::resource('classrooms.classworks' ,ClassworkController::class);
        Route::get('/clasroom/{classroom}/people',[ClassroomPeopleController::class,'index'])->name('classrooms.people');
        Route::delete('/clasroom/{classroom}/people',[ClassroomPeopleController::class,'destroy'])->name('classrooms.people.destroy');

        Route::post('comments',[CommentController::class, 'store'])->name('comments.store');
        Route::post('classworks/{classwork}/submissions',[SubmissionController::class, 'store'])->name('submissions.store');

        Route::get('submissions/{submission}/file',[SubmissionController::class,'file'])->name('submissions.file');

    });

    // Route::post('/payments/stripe/webhook',StripeController::class);


