<?php

use App\Http\Controllers\employee\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\member\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\schedule\ScheduleBookingController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\PermissionController;
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

// Route::middleware(['auth', 'user-type:admin'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::group(['middleware' => ['auth','role:super-admin|member', 'permission:add member|edit member|view member']], function () {
    Route::get('/members/admission', [MemberController::class, 'admission'])->name('member-admission');
    Route::get('/member/{id}', [MemberController::class, 'read'])->name('member-read');
    Route::get('/members/update/{id}', [MemberController::class, 'update'])->name('member-update');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member-edit');
    Route::post('/members/save', [MemberController::class, 'save'])->name('member-add');
});

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:delete member']], function () {
    Route::delete('/member/delete', [MemberController::class, 'delete'])->name('member-delete');
});

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:view member-list']], function () {
    Route::get('/members', [MemberController::class, 'index'])->name('member-index');
});


Route::controller(ScheduleBookingController::class)->group(function(){
    Route::get('schedule/book',[ScheduleBookingController::class,'view'])->name('schedule-book');
    Route::post('schedule/book',[ScheduleBookingController::class,'addSchedule'])->name('schedule-book');
    Route::get('schedule/calender-schedules',[ScheduleBookingController::class,'getScheduleForCalender'])->name('calender-schedules');
});

Route::controller(UserController::class)->group(function(){
    Route::get('user/add',[UserController::class,'add'])->name('user-add');
    Route::post('user/save',[UserController::class,'save'])->name('user-save');
    Route::match(array('GET', 'POST'), 'user/password/update',[UserController::class,'updatePassword'])->name('password-update');
});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('employee/index',[EmployeeController::class,'index'])->name('inployee-index');
});

Route::controller(PaymentController::class)->group(function(){
    Route::get('payment/index',[PaymentController::class,'index'])->name('payment-index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//=======================================================================
//User Role
Route::get('roles',[UserRoleController::class,'index'])->name('role-index');
//=======================================================================
//=======================================================================
//Permission
Route::get('permissions/{role_id}/{role_name}',[PermissionController::class,'index'])->name('permission-index');
Route::post('assign',[PermissionController::class,'assignPermission'])->name('permission-assign');
//=======================================================================
require __DIR__.'/auth.php';
