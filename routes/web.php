<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginadminController;

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

Route::get('/admin/adduser', function () {
    return view('auth/register');
})->name('regis');;

Auth::routes();

Route::get('/datakolam/{idtambak}', function ($idtambak) {
    return view('nelayan/data_kolam',['idtambak'=>$idtambak]);
})->name('datakolam');

Route::get('/datanelayan', function () {
    return view('admin/datauser_nelayan');
})->name('datanelayan');

Route::get('/data_list_alat', function () {
    return view('nelayan/data_listalat');
})->name('listalat');

Route::get('dataalat/{id_kolam}', function ($id_kolam) {
    return view('nelayan/data_alat',['id_kolam'=>$id_kolam]);
})->name('dataalat');

Route::get('/dashboard', function () {
    return view('layouts/dashboard');
});

Route::get('/monitor_tambak', function () {
    return view('admin/monitor_tambak');
})->name('monitortambak');

Route::get('/regis', function () {
    return view('auth/register');
})->name('regis');

Route::get('/datatambak', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('datatambak')
    ->middleware('user','fireauth');


// Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);
