<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\member\MemberController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::controller(MemberController::class)->group(function () {
    Route::get('/members', [MemberController::class, 'index'])->name('member-index');
    Route::get('/members/admission', [MemberController::class, 'admission'])->name('member-admission');
    Route::post('/members/save', [MemberController::class, 'save'])->name('member-add');
});