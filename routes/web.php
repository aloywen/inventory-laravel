<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\BarangmasukController;


// Route::get('/', function () {
//     return view('welcome');
// }); 


// Route::get('/', [HomeController::class, 'index']);
Route::group(['middleware' => 'guest'],function () {
    Route::get('/', [LoginController::class, 'auth'])->name('log');
    Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
    // Route::get('/regist', [LoginController::class, 'regist']);
    // Route::post('/regist', [LoginController::class, 'registPost'])->name('register');
    // Route::get('/forgotpassword', [LoginController::class, 'forgotpassword']);
    
});

Route::group(['middleware' => 'auth'],function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::controller(AdminController::class)->group(function () {
        Route::get('/panel/dashboard','index');
        Route::get('/panel/role', 'role');
        Route::get('/panel/users', 'users');
    });
    
    // role
    Route::controller(RoleController::class)->group(function () {
        Route::post('/panel/role', 'store')->name('roleStore');
        Route::post('/panel/updaterole/{id}', 'update')->name('roleUpdate');
        Route::get('/panel/deleterole/{id}', 'delete')->name('deleteStore');
    });
    
    // users
    Route::controller(UserController::class)->group(function () {
        // Route::get('/panel/users', 'index');
        Route::post('/panel/user', 'store')->name('userStore');
        Route::post('/panel/updateuser/{id}', 'update')->name('userUpdate');
        Route::get('/panel/deleteuser/{id}', 'delete')->name('userDelete');
    });


    // supplier
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/panel/supplier', 'index')->name('supplier');
        Route::post('/panel/supplier', 'store')->name('supplierStore');
        Route::post('/panel/updatesupplier/{id}', 'update')->name('supplierUpdate');
        Route::get('/panel/deletesupplier/{id}', 'delete')->name('supplierDelete');
    });



    // barang
    Route::controller(BarangController::class)->group(function () {
        Route::get('/panel/barang', 'index')->name('barang');
        Route::get('/panel/autocompleteb', 'autocompleteKode')->name('autocompleteKBarang');
        Route::post('/panel/barang', 'store')->name('barangStore');
        Route::post('/panel/updatebarang/{id}', 'update')->name('barangUpdate');
        Route::get('/panel/deletebarang/{id}', 'delete')->name('barangDelete');
    });

    // Barang Masuk
    Route::controller(BarangmasukController::class)->group(function () {
        Route::get('/panel/barangmasuk', 'index')->name('barangmasuk');
        // Route::post('/panel/addbarangmasuk', 'add')->name('addmasuk');
        Route::get('/panel/addbarangmasuk', 'add')->name('bmasukAdd');
        Route::post('/panel/addbarangmasuk', 'store')->name('bmasukStore');
        Route::get('/panel/updatebarangmasuk/{no_transaksi}', 'edit')->name('bmasukEdit');
        Route::post('/panel/updatebarangmasuk/{no_transaksi}', 'update')->name('bmasukUpdate');
        Route::get('/panel/deleteBmasuk/{id}', 'delete')->name('bmasukDelete');
        Route::get('/panel/printbarangmasuk/{no_transaksi}', 'print')->name('bmasukPrint');
    });
    
    // Barang Keluar
    Route::controller(BarangkeluarController::class)->group(function () {
        Route::get('/panel/barangkeluar', 'index')->name('barangkeluar');
        Route::post('/panel/barangkeluar', 'store')->name('BkeluarStore');
        Route::post('/panel/updateBkeluar/{id}', 'update')->name('BkeluarUpdate');
        Route::get('/panel/deleteBkeluar/{id}', 'delete')->name('BkeluarDelete');
    });

    // Laporan
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/panel/laporan', 'index')->name('laporan');
        Route::post('/panel/printlaporan', 'print')->name('laporanPrint');
    });


});
