<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlokirController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PosCustomAuthController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AdminVisitorController;
use App\Http\Controllers\PosVisitorController;
use App\Http\Controllers\SimbController;
use App\Http\Controllers\AdminSimbController;
use App\Http\Controllers\PosSimbController;

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
Route::resource('visitor',VisitorController::class);
Route::resource('simb',SimbController::class);
Route::get('guest/verifikasi/{id}',[AdminController::class,'verifikasi'])->name('verifikasikib');
Route::group(['prefix' => 'admin'],function(){
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::resource('guest', AdminController::class)->except([
        'store'
    ]);
    Route::resource('visitor', AdminVisitorController::class ,[
        'as' => 'admin'
    ]);
    Route::get('visitor/keluar/{id}',[AdminVisitorController::class,'keluar'])->name('keluarvisitor');
    Route::get('visitor/verifikasi/{id}',[AdminVisitorController::class,'verifikasi'])->name('verifikasivisitor');
    Route::resource('simb', AdminSimbController::class ,[
        'as' => 'admin'
    ]);
    Route::get('simb/verifikasi/{id}',[AdminSimbController::class,'verifikasi'])->name('verifikasisimb');
    Route::resource('blokir', BlokirController::class);
    Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard');
});
Route::get('pos/login', [PosCustomAuthController::class, 'index'])->name('poslogin');
Route::group(['prefix' => 'pos'],function(){
    Route::resource('visitor', PosVisitorController::class ,[
        'as' => 'pos'
    ]);
    Route::get('visitor/keluar/{id}',[PosVisitorController::class,'keluar'])->name('poskeluarvisitor');
    Route::get('visitor/verifikasi/{id}',[PosVisitorController::class,'verifikasi'])->name('posverifikasivisitor');
    Route::post('custom-login', [PosCustomAuthController::class, 'customLogin'])->name('poslogin.custom'); 
    Route::get('signout', [PosCustomAuthController::class, 'signOut'])->name('possignout');
    Route::get('/',[PosController::class, 'index'])->name('pos.dashboard');
    Route::get('/blokir',[PosController::class, 'indexblokir'])->name('pos.blokir');
});