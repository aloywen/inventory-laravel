<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FiturController;
use App\Http\Controllers\LoketController;


// Route::get('/', function () {
//     return view('welcome');
// }); 


Route::get('/', [HomeController::class, 'index']);
Route::group(['middleware' => 'guest'],function () {
    Route::get('/auth', [LoginController::class, 'auth']);
    Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
    Route::get('/regist', [LoginController::class, 'regist']);
    Route::post('/regist', [LoginController::class, 'registPost'])->name('register');
    Route::get('/forgotpassword', [LoginController::class, 'forgotpassword']);
    
});

Route::group(['middleware' => 'auth'],function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::controller(AdminController::class)->group(function () {
        Route::get('/panel/dashboard','index');
        Route::get('/panel/role', 'role');
        Route::get('/panel/users', 'users');
        Route::get('/panel/category', 'category');
    });

    // role
    Route::controller(RoleController::class)->group(function () {
        Route::post('/panel/role', 'store')->name('roleStore');
        Route::post('/panel/updaterole/{id}', 'update')->name('roleUpdate');
        Route::get('/panel/deleterole/{id}', 'delete')->name('deleteStore');
    });

    // users
    Route::controller(UserController::class)->group(function () {
        Route::post('/panel/user', 'store')->name('userStore');
        Route::post('/panel/updateuser/{id}', 'update')->name('userUpdate');
        Route::get('/panel/deleteuser/{id}', 'delete')->name('userDelete');
    });

    // Jumlah Loket
    Route::controller(LoketController::class)->group(function () {
        Route::get('/panel/loket', 'index')->name('loket');
        Route::post('/panel/loket', 'store')->name('loketStore');
        Route::post('/panel/updateloket/{id}', 'update')->name('loketUpdate');
        Route::get('/panel/deleteloket/{id}', 'delete')->name('loketDelete');
    });

    // Pesanan Penjualan
    Route::controller(PesananJualController::class)->group(function () {
        Route::post('/panel/po', 'store')->name('poStore');
        Route::post('/panel/updatpo/{id}', 'update')->name('poUpdate');
        Route::get('/panel/deletepo/{id}', 'delete')->name('poDelete');
    });


});
