<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;

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
Route::get('/', [Controller::class, 'viewLogin'])->name('admin.login');
Route::post('/', [Controller::class, 'auth'])->name('auth');

Route::group(['middleware' => 'web'],function() {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('add', [AdminController::class, 'create'])->name('admin.create');
    Route::post('store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/trashbin', [AdminController::class, 'trashbin'])->name('admin.trashbin');
    Route::get('/admin/search', [AdminController::class, 'index'])->name('admin.search');

    Route::get ('/mobil', [AdminController::class, 'mobilindex'])->name('mobil.mobil');
    Route::get ('/mobil/add', [AdminController::class, 'createMobil'])->name('mobil.create');
    Route::post('/mobil/store', [AdminController::class, 'storeMobil'])->name('mobil.store');
    Route::get('/mobil/edit/{id}', [AdminController::class, 'editMobil'])->name('mobil.edit');
    Route::post('/mobil/update/{id}', [AdminController::class, 'updateMobil'])->name('mobil.update');
    Route::post('/mobil/delete/{id}', [AdminController::class, 'deleteMobil'])->name('mobil.delete');
    Route::get('/mobil/soft-delete/{id}', [AdminController::class, 'softDeleteMobil'])->name('mobil.softDelete');
    Route::get('/mobil/restore/{id}', [AdminController::class, 'restoreMobil'])->name('mobil.restore');
    Route::get('/mobil/search', [AdminController::class, 'mobilindex'])->name('mobil.search');

    Route::get ('/karyawan', [AdminController::class, 'karyawanindex'])->name('karyawan.karyawan');
    Route::get ('/karyawan/add', [AdminController::class, 'createKaryawan'])->name('karyawan.create');
    Route::post('/karyawan/store', [AdminController::class, 'storeKaryawan'])->name('karyawan.store');
    Route::get('/karyawan/edit/{id}', [AdminController::class, 'editKaryawan'])->name('karyawan.edit');
    Route::post('/karyawan/update/{id}', [AdminController::class, 'updateKaryawan'])->name('karyawan.update');
    Route::post('/karyawan/delete/{id}', [AdminController::class, 'deletekaryawan'])->name('karyawan.delete');
    Route::get('/karyawan/soft-delete/{id}', [AdminController::class, 'softDeleteKaryawan'])->name('karyawan.softDelete');
    Route::get('/karyawan/trashbin', [AdminController::class, 'trashbinKaryawan'])->name('karyawan.trashbin');
    Route::get('/karyawan/restore/{id}', [AdminController::class, 'restoreKaryawan'])->name('karyawan.restore');
    Route::get('/karyawan/search', [AdminController::class, 'karyawanindex'])->name('karyawan.search');

    Route::get ('/customers', [AdminController::class, 'customersIndex'])->name('customers.customers');
    Route::get('/customer/add', [AdminController::class, 'createCustomer'])->name('customer.create');
    Route::post('/customer/store', [AdminController::class, 'storeCustomer'])->name('customer.store');
    Route::get('/customer/edit/{id}', [AdminController::class, 'editCustomer'])->name('customer.edit');
    Route::post('/customer/update/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::post('/customer/delete/{id}', [AdminController::class, 'deleteCustomer'])->name('customer.delete');
    Route::get('/customer/soft-delete/{id}', [AdminController::class, 'softDeleteCustomer'])->name('customer.softDelete');
    Route::get('/customer/trashbin', [AdminController::class, 'trashbinCustomer'])->name('customer.trashbin');
    Route::get('/customer/restore/{id}', [AdminController::class, 'restoreCustomer'])->name('customer.restore');
    Route::get('/customers/search', [AdminController::class, 'customersIndex'])->name('customers.search');    
    }); 