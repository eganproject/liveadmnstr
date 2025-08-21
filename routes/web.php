<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('', function () {
        return view('admin.dashboard.index');
    });
});
Route::get('/', function () {
    return redirect('/login');
});

Route::auth(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
