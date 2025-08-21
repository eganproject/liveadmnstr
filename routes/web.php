<?php

use App\Http\Controllers\Admin\DataHarian\PendapatanHarianController;
use App\Http\Controllers\Admin\Masterdata\JabatanController;
use App\Http\Controllers\Admin\Masterdata\KaryawanController;
use App\Http\Controllers\Admin\Masterdata\TokoController;
use App\Http\Controllers\Admin\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('', function () {
        return view('admin.dashboard.index');
    });

    Route::group(['prefix'=> 'masterdata'], function () {
    
        Route::resource('jabatan', JabatanController::class)->names('admin.masterdata.jabatan');
        Route::resource('toko', TokoController::class)->names('admin.masterdata.toko');
        Route::resource('karyawan', KaryawanController::class)->names('admin.masterdata.karyawan');
    });

    Route::group(['prefix' => 'dataharian'], function(){
        Route::resource('pendapatan-harian', PendapatanHarianController::class)->names('admin.dataharian.pendapatan-harian');
    });

    // New Reports Route
    Route::group(['prefix' => 'reports'], function() {
        Route::get('pendapatan', [ReportController::class, 'index'])->name('admin.reports.pendapatan.index');
    });

});
Route::get('/', function () {
    return redirect('/login');
});

Route::auth(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');