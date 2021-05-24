<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InstallController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PrefixController;
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
    return redirect('/complaint');
});
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
