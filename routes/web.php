<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RadioProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
 

Auth::routes();

Route::get('/', [FrontController::class, 'welcome']);
Route::get('radioprograms/{id}', [RadioProgramController::class,'show']);

Route::group(['middleware' => 'auth',], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('radio-programs', RadioProgramController::class);
});
