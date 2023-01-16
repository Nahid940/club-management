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
use \App\Http\Controllers\SettingsController;
use App\Http\Controllers\member\MemberPaymentController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\MemberBookController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\MemberClassificationController;
use App\Http\Controllers\report\PaymentReportController;
use App\Http\Controllers\report\DonationReportController;
use App\Http\Controllers\EmailConfigController;
use App\Http\Controllers\DonationPurposeController;
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


Route::group(['middleware' => ['auth','role:super-admin|member']], function () {
    Route::get('/members/admission', [MemberController::class, 'admission'])->middleware('permission:add member')->name('member-admission');
    Route::get('/member/{id}', [MemberController::class, 'read'])->name('member-read')->middleware('permission:view member');
    Route::get('new/member/{id}', [MemberController::class, 'newApplicants'])->name('new-member-read');
    Route::get('/members/update/{id}', [MemberController::class, 'update'])->name('member-update');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->middleware('permission:edit member')->name('member-edit');
    Route::post('/members/save', [MemberController::class, 'save'])->name('member-add');
    Route::get('/members/profile', [MemberController::class, 'profile'])->name('member-profile');
    Route::get('members/info/update', [MemberController::class, 'memberProfileUpdate'])->name('member-profile-update');
    Route::post('members/info/update/{id}', [MemberController::class, 'updateProfile'])->name('update_profile');
    Route::post('member-education/delete', [MemberController::class, 'educationDelete'])->name('education-delete');
    Route::post('row-delete', [MemberController::class, 'clubDelete']);
    Route::post('row-delete', [MemberController::class, 'dependentDelete']);
});

Route::get('settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
Route::post('settings', [SettingsController::class, 'save'])->name('save-settings')->middleware('auth');

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:delete member']], function () {
    Route::delete('/member/delete', [MemberController::class, 'delete'])->name('member-delete');
});

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:approve member|decline member']], function () {
    Route::post('/member/approve', [MemberController::class, 'approve'])->name('member-approve');
    Route::post('/member/decline', [MemberController::class, 'decline'])->name('member-decline');
    Route::post('approve-all', [MemberController::class, 'approve'])->name('approve-all-applications');
});

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:view member-list']], function () {
    Route::get('/members', [MemberController::class, 'index'])->name('member-index');
    Route::get('/members/new', [MemberController::class, 'newApplications'])->name('new-applications-index');
});

Route::post('/member/search', [MemberController::class, 'search'])->name('member-search');
Route::get('/member/doc/preview/{nid}/{type}', [MemberController::class, 'previewDoc'])->name('member-doc-preview');


Route::controller(ScheduleBookingController::class)->group(function(){
    Route::get('schedule/book',[ScheduleBookingController::class,'view'])->name('schedule-book');
    Route::post('schedule/book',[ScheduleBookingController::class,'addSchedule'])->name('schedule-book');
    Route::get('schedule/calender-schedules',[ScheduleBookingController::class,'getScheduleForCalender'])->name('calender-schedules');
});

Route::group(['middleware' => ['auth','role:super-admin|admin', 'permission:add user|delete user']],function(){
    Route::get('user/index',[UserController::class,'index'])->name('user-index');
    Route::get('user/add',[UserController::class,'add'])->name('user-add');
    Route::post('user/save',[UserController::class,'save'])->name('user-save');
    Route::delete('user/delete',[UserController::class,'delete'])->name('user-delete');
    Route::post('user/status/update',[UserController::class,'statusChange'])->name('user-status');
});
Route::match(array('GET', 'POST'), 'user/password/update',[UserController::class,'updatePassword'])->middleware('auth')->name('password-update');


Route::controller(EmployeeController::class)->group(function(){
    Route::get('employee/index',[EmployeeController::class,'index'])->name('inployee-index');
});

Route::controller(PaymentController::class)->group(function(){
    Route::get('payment/index',[PaymentController::class,'index'])->name('payment-index')->middleware('auth','role:super-admin|member|accountant','permission:view payment');
    Route::get('payment/add',[PaymentController::class,'add'])->name('payment-add')->middleware('auth','role:super-admin|member|accountant','permission:add payment');
    Route::get('payment/view/{id}',[PaymentController::class,'view'])->name('payment-view')->middleware('auth','role:super-admin|member|accountant','permission:view payment');
    Route::get('payment/edit/{id}',[PaymentController::class,'edit'])->name('payment-edit')->middleware('auth','role:super-admin|member|accountant','permission:edit payment');
    Route::post('payment/update',[PaymentController::class,'update'])->name('payment-update')->middleware('auth');
    Route::post('payment/add',[PaymentController::class,'save'])->name('payment-add')->middleware('auth');
    Route::post('process/payment',[PaymentController::class,'process'])->name('process-payment')->middleware('auth','role:super-admin|member|accountant','permission:approve payment|decline payment');
    Route::post('payment/delete',[PaymentController::class,'delete'])->name('payment-delete')->middleware('auth','role:super-admin|member|accountant','permission:delete payment');;
    Route::get('payment/types',[PaymentController::class,'paymentTypes'])->name('payment-types')->middleware('auth');
    Route::delete('payment/type/delete',[PaymentController::class,'typeDelete'])->name('payment-type-delete')->middleware('auth');
    Route::post('payment/type/status',[PaymentController::class,'typeStatus'])->name('payment-type-status')->middleware('auth');
    Route::get('payment/type/add',[PaymentController::class,'typeAdd'])->name('payment-type-add')->middleware('auth');
    Route::post('payment/type/add',[PaymentController::class,'typeSave'])->name('payment-type-save')->middleware('auth');
    Route::get('payment/export',[PaymentController::class,'export'])->name('payment-export')->middleware('auth');

});

Route::group(['middleware'=>['auth']],function (){
    Route::get('donation/index',[DonationController::class,'index'])->name('donation-index')->middleware('role:super-admin|accountant','permission:view donation');
    Route::get('donation/add',[DonationController::class,'add'])->name('donation-add')->middleware('role:super-admin|accountant','permission:add donation');
    Route::get('donation/view/{id}',[DonationController::class,'view'])->name('donation-view')->middleware('role:super-admin|accountant','permission:view donation');
    Route::post('donation/add',[DonationController::class,'save'])->name('donation-save');
    Route::post('donor/add',[DonorController::class,'donorAdd'])->name('donor-add');
    Route::post('donor/search',[DonorController::class,'search'])->name('donor-search');
    Route::post('process/donation',[DonationController::class,'process'])->name('process-donation')->middleware('role:super-admin|member|accountant','permission:approve donation');
    Route::post('donation/delete',[DonationController::class,'delete'])->name('donation-delete')->middleware('role:super-admin|member|accountant','permission:delete donation');
    Route::get('donation/edit/{id}',[DonationController::class,'edit'])->name('donation-edit')->middleware('role:super-admin|member|accountant','permission:edit donation');
    Route::post('donation/update',[DonationController::class,'update'])->name('donation-update');

});


Route::group(['middleware' => ['auth']],function (){
    Route::get('member-book',[MemberBookController::class,'index'])->name('member-book');
    Route::get('book-pdf',[MemberBookController::class,'pdf'])->name('book-pdf');
});

Route::group(['middleware' => ['auth']],function (){
    Route::get('classification-inedx',[MemberClassificationController::class,'index'])->name('classification-index');
    Route::post('classification-new',[MemberClassificationController::class,'add'])->name('classification-new');
    Route::post('classification-add',[MemberClassificationController::class,'save'])->name('classification-add');
    Route::get('classification-edit/{id}',[MemberClassificationController::class,'edit'])->name('classification-edit');
    Route::post('classification-update',[MemberClassificationController::class,'update'])->name('classification-update');
    Route::delete('classification-delete',[MemberClassificationController::class,'delete'])->name('classification-delete');
});

Route::group(['middleware' => ['auth']],function (){
    Route::get('purpose/index',[DonationPurposeController::class,'index'])->name('purpose-index');
    Route::get('purpose/add',[DonationPurposeController::class,'add'])->name('purpose-add');
    Route::post('purpose/add',[DonationPurposeController::class,'save'])->name('purpose-add');
    Route::delete('purpose/delete',[DonationPurposeController::class,'delete'])->name('purpose-delete');
    Route::get('purpose-update/{id}',[DonationPurposeController::class,'edit'])->name('purpose-edit');
    Route::post('purpose/update',[DonationPurposeController::class,'update'])->name('purpose-update');
});


Route::group(['middleware' => ['auth','role:super-admin|admin']],function (){
    Route::get('notice/list',[NoticeController::class,'index'])->name('notice-index');
    Route::get('notice/add',[NoticeController::class,'add'])->name('notice-add');
    Route::get('notice/edit/{id}',[NoticeController::class,'edit'])->name('notice-edit');
    Route::post('notice/add',[NoticeController::class,'save'])->name('notice-add');
    Route::post('notice/delete',[NoticeController::class,'delete'])->name('notice-delete');
    Route::post('notice/update',[NoticeController::class,'update'])->name('notice-update');
    Route::post('notice/postpone',[NoticeController::class,'postpone'])->name('notice-postpone');
});


Route::get('notice/view/{id}',[NoticeController::class,'view'])->middleware('auth')->name('notice-view');

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


//=====================================Members=================================================
Route::group(['middleware' => ['auth','role:member']], function () {
    Route::get('payments', [MemberPaymentController::class, 'index'])->name('member-payment-index');
    Route::get('view/payment/{id}', [MemberPaymentController::class, 'view'])->name('member-payment-view');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('payments/report', [PaymentReportController::class, 'index'])->name('payments-report-index');
    Route::post('payments/report', [PaymentReportController::class, 'report'])->name('payments-report');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('donation/report', [DonationReportController::class, 'index'])->name('donation-report-index');
    Route::post('donation/report', [DonationReportController::class, 'report'])->name('donation-report');
});


Route::get('import-members',[MemberController::class, 'import'])->name('import-members');
Route::get('email-config',[EmailConfigController::class, 'config'])->name('email-config')->middleware('auth');
Route::post('email-config',[EmailConfigController::class, 'save'])->name('email-config')->middleware('auth');

require __DIR__.'/auth.php';
