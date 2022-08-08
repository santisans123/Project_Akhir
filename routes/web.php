<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginadminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('welcome');
});

Route::get('/loginadmin', function () {
    return view('auth/loginadmin');
});

Auth::routes();

Route::get('datakolam/{idtambak}', function ($idtambak) {
    return view('nelayan/data_kolam',['idtambak'=>$idtambak]);
})->name('datakolam');

Route::get('dataalat/{id_kolam}', function ($id_kolam) {
    return view('nelayan/data_alat',['id_kolam'=>$id_kolam]);
})->name('dataalat');

Route::get('/datanelayan', function () {
    return view('admin/datauser_nelayan');
})->middleware('checkRole')->name('datanelayan');

Route::get('/dashboard', function () {
    return view('layouts/dashboard');
});

Route::get('/monitor_tambak', function () {
    return view('admin/monitor_tambak');
})->name('monitortambak');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('checkRole')
    ->withoutMiddleware(['guest'])
    ->name('register');

Route::post('register', [RegisterController::class, 'register'])
    ->middleware('checkRole')
    ->withoutMiddleware(['guest']);

Route::get('/datatambak', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('datatambak')
    ->middleware('user','fireauth');

// Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

// Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', [LoginController::class, 'handleCallback']);

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);
