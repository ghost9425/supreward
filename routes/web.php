<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InstallController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
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
Route::get('/complaint/list-ajax', [ComplaintController::class, 'listAjax'])->name('Complaint.listAjax');


