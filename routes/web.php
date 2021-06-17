<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InstallController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommonProblemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('Auth.login');
Route::post('/login/ajax', [AuthController::class, 'loginAjax'])->name('Auth.loginAjax');
Route::post('/login', [AuthController::class, 'loginSave'])->name('Auth.loginSave');
Route::get('/logout', [AuthController::class, 'logoutSave'])->name('Auth.logoutSave');

Route::group( [ 'middleware' => ['auth'] ], function () {
    // Route::get('/test', [TestController::class, 'test'])->name('Test.login');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');

    Route::get('/complaint', [ComplaintController::class, 'index'])->name('Complaint.index');
    Route::get('/complaint/add', [ComplaintController::class, 'add'])->name('Complaint.add');
    Route::post('/complaint/add-save', [ComplaintController::class, 'addSave'])->name('Complaint.addSave');
    Route::get('/complaint/edit/{id?}', [ComplaintController::class, 'edit'])->name('Complaint.edit');
    Route::post('/complaint/edit-save', [ComplaintController::class, 'editSave'])->name('Complaint.editSave');
    Route::post('complaint/ajax-delete', [ComplaintController::class, 'ajaxDelete'])->name('Complaint.ajaxDelete');
    Route::get('/complaint/list-ajax', [ComplaintController::class, 'listAjax'])->name('Complaint.listAjax');

    Route::get('/prefix', [PrefixController::class, 'index'])->name('Prefix.index');
    Route::get('/prefix/add', [PrefixController::class, 'add'])->name('Prefix.add');
    Route::post('/prefix/add-save', [PrefixController::class, 'addSave'])->name('Prefix.addSave');
    Route::get('/prefix/edit/{id?}', [PrefixController::class, 'edit'])->name('Prefix.edit');
    Route::post('/prefix/edit-save', [PrefixController::class, 'editSave'])->name('Prefix.editSave');
    Route::get('/prefix/list-ajax', [PrefixController::class, 'listAjax'])->name('Prefix.listAjax');

    Route::get('/commonproblem', [CommonProblemController::class, 'index'])->name('CommonProblem.index');
    Route::get('/commonproblem/add', [CommonProblemController::class, 'add'])->name('CommonProblem.add');
    Route::post('/commonproblem/add-save', [CommonProblemController::class, 'addSave'])->name('CommonProblem.addSave');
    Route::get('/commonproblem/edit/{id?}', [CommonProblemController::class, 'edit'])->name('CommonProblem.edit');
    Route::post('/commonproblem/edit-save', [CommonProblemController::class, 'editSave'])->name('CommonProblem.editSave');
    Route::get('/commonproblem/list-ajax', [CommonProblemController::class, 'listAjax'])->name('CommonProblem.listAjax');

    Route::get('/report', [ReportController::class, 'index'])->name('Report.index');
    Route::get('/report/list-ajax', [ReportController::class, 'listAjax'])->name('Report.listAjax');
});
