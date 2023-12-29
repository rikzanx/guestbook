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
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\AdminSuratJalanController;
use App\Http\Controllers\PosSuratJalanController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\AmbilKibController;

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
Route::resource('webhook', WebhookController::class);
Route::get('/', [GuestController::class, 'create'])->name('index');  
Route::get('admin/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('guest/store', [GuestController::class,'store'])->name('gueststore');  
Route::resource('visitor',VisitorController::class);
Route::resource('simb',SimbController::class);
Route::resource('suratjalan',SuratJalanController::class);
Route::resource('ambil-kib',AmbilKibController::class);

Route::get('guest/verifikasi/{id}',[AdminController::class,'verifikasi'])->name('verifikasikib');
Route::get('guest/verifikasiall',[AdminController::class,'verifikasiall'])->name('verifikasiall');
Route::get('verifikasisimball',[AdminSimbController::class,'verifikasiall'])->name('verifikasisimball');
Route::get('verifikasisuratjalanall',[AdminSuratJalanController::class,'verifikasiall'])->name('verifikasisuratjalanall');
Route::get('verifikasivisitorall',[AdminVisitorController::class,'verifikasiall'])->name('verifikasivisitorall');
Route::group(['prefix' => 'admin'],function(){
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    // guest
        Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('guest', AdminController::class)->except([
            'store'
        ]);
        Route::get('all/guest',[AdminController::class,'all'])->name('guest.all');
    // end guest

    // visitor
        Route::resource('visitor', AdminVisitorController::class ,[
            'as' => 'admin'
        ]);
        Route::get('visitor/keluar/{id}',[AdminVisitorController::class,'keluar'])->name('keluarvisitor');
        Route::get('visitor/verifikasi/{id}',[AdminVisitorController::class,'verifikasi'])->name('verifikasivisitor');
        Route::get('all/visitor',[AdminVisitorController::class,'all'])->name('visitor.all');
    // end visitor

    // blokir
        Route::resource('blokir', BlokirController::class);
        Route::get('all/blokir',[BlokirController::class,'all'])->name('blokir.all');
    // end blokir

    // simb
        Route::resource('simb', AdminSimbController::class ,[
            'as' => 'admin'
        ]);
        Route::get('simb/verifikasi/{id}',[AdminSimbController::class,'verifikasi'])->name('verifikasisimb');
        Route::get('all/simb',[AdminSimbController::class,'all'])->name('simb.all');
    // end simb

    // surat jalan
        Route::resource('suratjalan', AdminSuratJalanController::class ,[
            'as' => 'admin'
        ]);
        Route::get('suratjalan/verifikasi/{id}',[AdminSuratJalanController::class,'verifikasi'])->name('verifikasisuratjalan');
        Route::get('all/suratjalan',[AdminSuratJalanController::class,'all'])->name('suratjalan.all');
    // end suratjalan




});

Route::get('pos/login', [PosCustomAuthController::class, 'index'])->name('poslogin');
Route::group(['prefix' => 'pos'],function(){

    // visitor
    Route::resource('visitor', PosVisitorController::class ,[
        'as' => 'pos'
    ]);
    Route::get('visitor/keluar/{id}',[PosVisitorController::class,'keluar'])->name('poskeluarvisitor');
    Route::get('visitor/verifikasi/{id}',[PosVisitorController::class,'verifikasi'])->name('posverifikasivisitor');
    // end visitor


    // simb
    Route::resource('simb', PosSimbController::class ,[
        'as' => 'pos'
    ]);
    Route::get('simb/verifikasi/{id}',[PosSimbController::class,'verifikasi'])->name('posverifikasisimb');
    // end simb


    // surat jalan
    Route::resource('suratjalan', PosSuratJalanController::class ,[
     
        'as' => 'pos'
    ]);
    Route::get('suratjalan/verifikasi/{id}',[PosSuratJalanController::class,'verifikasi'])->name('posverifikasisuratjalan');
    // end surat jalan


    Route::post('custom-login', [PosCustomAuthController::class, 'customLogin'])->name('poslogin.custom'); 
    Route::get('signout', [PosCustomAuthController::class, 'signOut'])->name('possignout');
    Route::get('/',[PosController::class, 'index'])->name('pos.dashboard');
    Route::get('/blokir',[PosController::class, 'indexblokir'])->name('pos.blokir');
});