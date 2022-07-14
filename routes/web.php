<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\DistricController;
use App\Http\Controllers\MedichineClassController;
use App\Http\Controllers\MedichineController;
use App\Http\Controllers\MedichinePreparationController;
use App\Http\Controllers\MedichineSubclassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->group(function () {
    Route::resource('province', ProvinceController::class);
    Route::resource('kabupaten', CitiesController::class);
    Route::resource('kecamatan', DistricController::class);
    Route::resource('kelas-obat', MedichineClassController::class);
    Route::resource('subkelas-obat', MedichineSubclassController::class);
    Route::resource('sediaan-obat', MedichinePreparationController::class);
    Route::resource('obat', MedichineController::class);
    Route::get('/tambah-obat/{id}', [MedichineController::class, 'ajaxSubkelas'])->name('obat.ajaxSubkelas');
});
