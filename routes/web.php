<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataHarian\PendapatanHarianController;
use App\Http\Controllers\Admin\Masterdata\JabatanController;
use App\Http\Controllers\Admin\Masterdata\KaryawanController;
use App\Http\Controllers\Admin\Masterdata\TokoController;
use App\Http\Controllers\Admin\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix'=> 'masterdata', 'as' => 'masterdata.'], function () {
    
        Route::resource('jabatan', JabatanController::class);
        Route::resource('toko', TokoController::class);
        Route::resource('karyawan', KaryawanController::class);
    });

    Route::group(['prefix' => 'dataharian', 'as' => 'dataharian.'], function(){
        Route::resource('pendapatan-harian', PendapatanHarianController::class);
    });

    // New Reports Route
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function() {
        Route::get('pendapatan', [ReportController::class, 'index'])->name('pendapatan.index');
    });

});
Route::get('/', function () {
    return redirect('/login');
});

Route::auth(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
