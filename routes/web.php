<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\Auth\LoginController;
use App\Http\Controllers\backend\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();







Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::group(['prefix'=>'admin'], function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    // admin.index-- route a (admin.admin.index) ri vabe dewyar dorkar chilo kintu ami dei ni
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admins/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admins/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('admins/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('admins/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    // Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    // Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    // Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    // Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    // Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    // Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');



    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit', [LoginController::class, 'admin_login'])->name('admin.login.submit');


    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('admin.password.update');

});