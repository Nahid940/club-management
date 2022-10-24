<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\member\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\schedule\ScheduleBookingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });




Route::middleware(['auth', 'user-type:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::controller(MemberController::class)->group(function () {
    Route::get('/member/{id}', [MemberController::class, 'read'])->name('member-read');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member-edit');
    Route::get('/members', [MemberController::class, 'index'])->name('member-index');
    Route::get('/members/admission', [MemberController::class, 'admission'])->name('member-admission');
    Route::post('/members/save', [MemberController::class, 'save'])->name('member-add');
    Route::get('/members/update/{id}', [MemberController::class, 'update'])->name('member-update');
});

Route::controller(ScheduleBookingController::class)->group(function(){
    Route::get('schedule/book',[ScheduleBookingController::class,'view'])->name('schedule-book');
    Route::post('schedule/book',[ScheduleBookingController::class,'addSchedule'])->name('schedule-book');
    Route::get('schedule/calender-schedules',[ScheduleBookingController::class,'getScheduleForCalender'])->name('calender-schedules');
});

Route::controller(UserController::class)->group(function(){
    Route::get('user/add',[UserController::class,'add'])->name('user-add');
    Route::post('user/save',[UserController::class,'save'])->name('user-save');
});

Route::controller(PaymentController::class)->group(function(){
    Route::get('payment/index',[PaymentController::class,'index'])->name('payment-index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
