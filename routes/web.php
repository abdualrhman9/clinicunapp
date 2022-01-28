<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailController;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','can:show:dashboard'])->prefix('dashboard')->name('dashboard.')->group(function(){
    Route::get('home',[DashboardController::class,'home'])->name('home');

    Route::get('emails',[EmailController::class,'index'])->name('emails.index');
    Route::get('emails/create',[EmailController::class,'create'])->name('emails.create');
    Route::post('emails',[EmailController::class,'store'])->name('emails.store');
    Route::post('emails/{email}',[EmailController::class,'destroy'])->name('emails.destroy');

});
