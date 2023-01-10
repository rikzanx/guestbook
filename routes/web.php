<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlokirController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PosCustomAuthController;
use App\Http\Controllers\PosController;

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

Route::get('/', [GuestController::class, 'create'])->name('index');  
Route::get('admin/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('guest/store', [GuestController::class,'store'])->name('gueststore');  
Route::get('guest/verifikasi/{id}',[AdminController::class,'verifikasi'])->name('verifikasikib');
Route::group(['prefix' => 'admin'],function(){
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::resource('guest', AdminController::class)->except([
        'store'
    ]);
    Route::resource('blokir', BlokirController::class);
    Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard');
});
Route::get('pos/login', [PosCustomAuthController::class, 'index'])->name('poslogin');
Route::group(['prefix' => 'pos'],function(){
    Route::post('custom-login', [PosCustomAuthController::class, 'customLogin'])->name('poslogin.custom'); 
    Route::get('signout', [PosCustomAuthController::class, 'signOut'])->name('possignout');
    Route::get('/',[PosController::class, 'index'])->name('pos.dashboard');
    Route::get('/blokir',[PosController::class, 'indexblokir'])->name('pos.blokir');
});