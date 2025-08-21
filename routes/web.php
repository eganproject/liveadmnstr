<?php

use App\Http\Controllers\Admin\Masterdata\JabatanController;
use App\Http\Controllers\Admin\Masterdata\TokoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('', function () {
        return view('admin.dashboard.index');
    });

    Route::group(['prefix'=> 'masterdata'], function () {
    
        Route::resource('jabatan', JabatanController::class)->names('admin.masterdata.jabatan');
        Route::resource('toko', TokoController::class)->names('admin.masterdata.toko');
    });

});
Route::get('/', function () {
    return redirect('/login');
});

Route::auth(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
