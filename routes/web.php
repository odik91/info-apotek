<?php

use App\Http\Controllers\Apotek\MainController;
use App\Http\Controllers\Apotek\MedicalDeviceController;
use App\Http\Controllers\Apotek\MedichineManagementController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\DistricController;
use App\Http\Controllers\MedicalDeviceCategoryConroller;
use App\Http\Controllers\MedicalDeviceClassController;
use App\Http\Controllers\MedicalDeviceGroupController;
use App\Http\Controllers\MedicalDevicePropertiesController;
use App\Http\Controllers\MedicalDeviceRiskClassController;
use App\Http\Controllers\MedicalEquipmentController;
use App\Http\Controllers\MedichineClassController;
use App\Http\Controllers\MedichineController;
use App\Http\Controllers\MedichinePreparationController;
use App\Http\Controllers\MedichineSubclassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SearchController;
use phpDocumentor\Reflection\DocBlock\Tags\See;

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
    return redirect()->route('apotek.index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect()->route('search.index');
})->name('home');

// Route pengunjung
Route::resource('search', SearchController::class);

// route search apotek
Route::get('search-apotek', [SearchController::class, 'searchApotek'])->name('search.searchApotek');
Route::get('/view-apotek/{id}', "App\Http\Controllers\SearchController@showApotek")->name('search.showApotek');

// route search obat
Route::get('search-obat', [SearchController::class, 'indexObat'])->name('search.obat');
Route::get('search-obat-result', [SearchController::class, 'searchObat'])->name('search.searchObat');
Route::get('detail-obat-result/{apotek}/{medichine}', [SearchController::class, 'viewDetailMedichine'])->name('search.viewDetailMedichine');

// route search alkes
Route::get('search-alkes', [SearchController::class, 'indexAlkes'])->name('search.alkes');
Route::get('search-alkes-result', [SearchController::class, 'searchAlkes'])->name('search.searchAlkes');
Route::get('detail-alkes-result/{apotek}/{medicalDevice}', [SearchController::class, 'viewDetailMedicalDevice'])->name('search.viewDetailMedicalDevice');

// This route below used for webmaster
// Route::prefix('setting')->group(function () {
//     Route::resource('province', ProvinceController::class);
//     Route::resource('kabupaten', CitiesController::class);
//     Route::resource('kecamatan', DistricController::class);

//     // route obat
//     Route::resource('kelas-obat', MedichineClassController::class);
//     Route::resource('subkelas-obat', MedichineSubclassController::class);
//     Route::resource('sediaan-obat', MedichinePreparationController::class);
//     Route::resource('obat', MedichineController::class);
//     Route::get('/tambah-obat/{id}', [MedichineController::class, 'ajaxSubkelas'])->name('obat.ajaxSubkelas');

//     // route alkes
//     Route::resource('kelompok-alkes', MedicalDeviceGroupController::class);
//     Route::resource('kategori-alkes', MedicalDeviceCategoryConroller::class);
//     Route::resource('kelas-alkes', MedicalDeviceClassController::class);
//     Route::resource('kelas-resiko', MedicalDeviceRiskClassController::class);
//     Route::resource('sifat-alkes', MedicalDevicePropertiesController::class);
//     Route::resource('alkes', MedicalEquipmentController::class);
// });

route::prefix('admin')->group(function () {
    // route user apotek
    Route::resource('apotek', MainController::class);
    Route::get('/apotek-city/{id}', [MainController::class, 'getCity'])->name('apotek.ajaxCity');
    Route::get('/apotek-distric/{id}', [MainController::class, 'getDistic'])->name('apotek.ajaxDistric');

    // route medichine management
    Route::resource('manage-medichine', MedichineManagementController::class);
    Route::get('/search-medichie', [MedichineManagementController::class, 'cariObat'])->name('manage-medichine.search');

    // route medical device management
    Route::resource('medical-device', MedicalDeviceController::class);
    Route::post('/set-device', [MedicalDeviceController::class, 'setAvailability'])->name('medical-device.setDevice');
    Route::post('/get-device', [MedicalDeviceController::class, 'cariAlkes'])->name('medical-device.getDevice');
});
