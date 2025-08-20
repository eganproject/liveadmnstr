<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->get('/admin', function () {
    return view('admin.dashboard.index');
});

Route::auth(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
