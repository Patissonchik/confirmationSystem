<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings/request-change', [SettingController::class, 'requestChange'])->name('settings.requestChange');
Route::post('/settings/confirm-change', [SettingController::class, 'confirmChange'])->name('settings.confirmChange');
