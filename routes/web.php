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
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\report\BatchwiseReportController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProfessionWiseReportController;
use App\Http\Controllers\report\BloodGroupWiseReportController;
use App\Http\Controllers\report\DOBwiseReportController;
use App\Http\Controllers\report\DueReporController;
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


Route::group(['middleware' => ['auth','role:super-admin|admin|member']], function () {
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

    Route::get('membership-fees',[MemberController::class,'fees'])->name('membership-fees');
    Route::get('save-membership-fees',[MemberController::class,'feesAdd'])->name('membership-fees-add');
    Route::post('save-membership-fees',[MemberController::class,'saveFees'])->name('membership-fees-add');
    Route::get('fee-edit/{id}',[MemberController::class,'feeEdit'])->name('fee-edit');
    Route::post('membership-fees-update',[MemberController::class,'feesUpdate'])->name('membership-fees-update');
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
    Route::get('/member-payment-schedule/{id}', [MemberController::class, 'schedule'])->name('payment-schedule');
    Route::get('/members/new', [MemberController::class, 'newApplications'])->name('new-applications-index');
    Route::get('/members/postponed', [MemberController::class, 'postponedMembers'])->name('postponed-member-index');
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
    Route::post('payment/export',[PaymentController::class,'getExportFile'])->name('payment-export')->middleware('auth');
    Route::post('paymentdetals-delete',[PaymentController::class,'paymentDetailsDelete'])->name('paymentdetals-delete')->middleware('auth');

});

Route::group(['middleware'=>['auth']],function (){
    Route::get('donation/index',[DonationController::class,'index'])->name('donation-index')->middleware('role:super-admin|accountant','permission:view donation');
    Route::get('donation/add',[DonationController::class,'add'])->name('donation-add')->middleware('role:super-admin|accountant','permission:add donation');
    Route::get('donation/view/{id}',[DonationController::class,'view'])->name('donation-view')->middleware('role:super-admin|accountant','permission:view donation');
    Route::post('donation/add',[DonationController::class,'save'])->name('donation-save');
    Route::post('donor/add-ajax',[DonorController::class,'donorAdd'])->name('donor-add');
    Route::post('donor/search',[DonorController::class,'search'])->name('donor-search');
    Route::post('process/donation',[DonationController::class,'process'])->name('process-donation')->middleware('role:super-admin|member|accountant','permission:approve donation');
    Route::post('donation/delete',[DonationController::class,'delete'])->name('donation-delete')->middleware('role:super-admin|member|accountant','permission:delete donation');
    Route::get('donation/edit/{id}',[DonationController::class,'edit'])->name('donation-edit')->middleware('role:super-admin|member|accountant','permission:edit donation');
    Route::post('donation/update',[DonationController::class,'update'])->name('donation-update');
    Route::get('donor/index',[DonorController::class,'index'])->name('donor-index');
    Route::delete('donor/delete',[DonorController::class,'delete'])->name('donor-delete');
    Route::get('donor/edit/{id}',[DonorController::class,'edit'])->name('donor-edit');
    Route::post('donor/update',[DonorController::class,'update'])->name('donor-update');
    Route::get('donor/add',[DonorController::class,'addDonor'])->name('add-donor');
    Route::post('donor/add',[DonorController::class,'donorSave'])->name('add-donor');

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



Route::group(['middleware' => ['auth']],function (){
    Route::get('occupation-index',[OccupationController::class,'index'])->name('occupation-index');
    Route::get('occupation-add',[OccupationController::class,'add'])->name('occupation-add');
    Route::get('occupation-edit/{id}',[OccupationController::class,'edit'])->name('occupation-edit');
    Route::post('occupation-update',[OccupationController::class,'update'])->name('occupation-update');
    Route::post('occupation-add',[OccupationController::class,'save'])->name('occupation-add');
    Route::delete('occupation-delete',[OccupationController::class,'delete'])->name('occupation-delete');
});

Route::group(['middleware' => ['auth']],function () {
    Route::get('batch-wise-report-index', [BatchwiseReportController::class, 'index'])->name('batch-wise-report-index');
    Route::post('batch-wise-report', [BatchwiseReportController::class, 'report'])->name('batch-wise-report');
});

Route::group(['middleware' => ['auth','role:billing-manager|super-admin']],function () {
    Route::get('bill-view/{id}', [BillingController::class, 'view'])->name('bill-view');
    Route::post('bill-add', [BillingController::class, 'save'])->name('bill-add');
    Route::get('bill-index', [BillingController::class, 'index'])->name('bill-index');
    Route::get('bill-edit/{id}', [BillingController::class, 'edit'])->name('bill-edit');
    Route::post('bill-update', [BillingController::class, 'update'])->name('bill-update');
    Route::post('bill-delete', [BillingController::class, 'delete'])->name('bill-delete');
    Route::get('bill-report', [BillingController::class, 'report'])->name('bill-report');
    Route::post('bill-report', [BillingController::class, 'getReport'])->name('bill-report');
    Route::get('dob-report', [DOBwiseReportController::class, 'index'])->name('dob-report');
    Route::post('dob-report', [DOBwiseReportController::class, 'report'])->name('dob-report');
});

Route::post('payment/get-due',[PaymentController::class,'getDue'])->name('get-due');

Route::group(['middleware' => ['auth']],function () {
    Route::get('profession-report-index', [ProfessionWiseReportController::class, 'index'])->name('profession-report-index');
    Route::post('profession-report-report', [ProfessionWiseReportController::class, 'report'])->name('profession-report');

    Route::get('blood-group-report-index', [BloodGroupWiseReportController::class, 'index'])->name('blood-group-report-index');
    Route::post('blood-group-report', [BloodGroupWiseReportController::class, 'report'])->name('blood-group-report');


    Route::get('member-due-index', [DueReporController::class, 'getMemberWiseDueIndex'])->name('member-due-report-index');
    Route::post('member-due-report', [DueReporController::class, 'getMemberWiseDue'])->name('member-due-report');


    Route::get('membership-due-index', [DueReporController::class, 'getMembershipWiseDueIndex'])->name('membership-due-report-index');
    Route::post('membership-due-report', [DueReporController::class, 'getMembershipWiseDue'])->name('membership-due-report');

    Route::get('member-fee-due-index',[DueReporController::class,'memberFeeDueIndex'])->name('member-fee-due-index');
    Route::post('member-fee-due-report',[DueReporController::class,'memberFeeDueReport'])->name('member-fee-due-report');

});

Route::get('fees/{id}/{member_id}',[PaymentController::class,'fees']);

Route::get('cache-clear',function (){
    \Illuminate\Support\Facades\Artisan::call('permission:cache-reset');
    return "Cache Cleared";
});

Route::get('data-clear',function (){
    \App\Models\Payment::truncate();
    \App\Models\PaymentDetails::truncate();
    \App\Models\PaymentDetails::truncate();
    \Illuminate\Support\Facades\DB::table('club_memberships')->truncate();
    \Illuminate\Support\Facades\DB::table('member_dependant_lists')->truncate();
    \Illuminate\Support\Facades\DB::table('member_educations')->truncate();
    \Illuminate\Support\Facades\DB::table('payment_details')->truncate();
    \Illuminate\Support\Facades\DB::table('billings')->truncate();
    \App\Models\Member::truncate();
    echo "Data truncated";
});


Route::get('backup',function (){
    Spatie\DbDumper\Databases\MySql::create()
        ->setDbName('ndc')
        ->setUserName('root')
        ->setPassword('Nahid940###***')
        ->dumpToFile('dump.sql');
});

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

require __DIR__.'/auth.php';
