<?php

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

Route::get('/logout',[\App\Http\Controllers\AuthController::class,'doLogout'])->name('logout');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', function () {
    return view('verification.download');
});

Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('doLogin');
Route::get('/login',[\App\Http\Controllers\AuthController::class,'showLogin'])->name('login');

Route::get('/register',[\App\Http\Controllers\AuthController::class,'showRegister'])->name('showRegister');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'doRegister'])->name('doRegister');

Route::group(['middleware'=>'auth'], function () {

    Route::post('/search', '\App\Http\Controllers\SearchController@search')->name("search");


    Route::get("/dashboard",[\App\Http\Controllers\DashboardController::class,'showDashboard']) -> name("showDashboard");

Route::get("/users/all",[\App\Http\Controllers\UsersController::class,'allUsers']) -> name("allUsers");
Route::get("/users/view/{id}",[\App\Http\Controllers\UsersController::class,'showUser']) -> name("showUser");

Route::post("/users/edit/",[\App\Http\Controllers\UsersController::class,'doEditUser']) -> name("doEditUser");

Route::get("/users/log/{id}",[\App\Http\Controllers\UsersController::class,'doEditUserLog']) -> name("doEditUserLog");

Route::get('/users/activate/{orgid}', '\App\Http\Controllers\UsersController@ActivateOrganisation')->name('ActivateOrganisation');

Route::post("/users/credit/",[\App\Http\Controllers\UsersController::class,'doCreditWallet']) -> name("doCreditWallet");
Route::post("/users/withdraw/",[\App\Http\Controllers\UsersController::class,'doWithdrawWallet']) -> name("doWithdrawWallet");


Route::get("/verify",[\App\Http\Controllers\VerificationController::class,'loadVerification']) -> name("loadVerification");
Route::post("/verify",[\App\Http\Controllers\VerificationController::class,'DoLoadVerification']) -> name("DoLoadVerification");
Route::post("/verify/demo",[\App\Http\Controllers\VerificationController::class,'DoLoadVerificationDemo']) -> name("DoLoadVerificationDemo");
Route::get("/verify/logs",[\App\Http\Controllers\VerificationController::class,'showLog']) -> name("showLog");
Route::post('/pdf/slip', '\App\Http\Controllers\PdfController@printSlip')->name("printSlip");
Route::post('/pdf/data', '\App\Http\Controllers\PdfController@downloadData')->name("downloadData");

Route::get('/settings',[\App\Http\Controllers\AuthController::class,'changePassword'])->name('changePassword');
Route::post('/settings',[\App\Http\Controllers\AuthController::class,'doChangePassword'])->name('doChangePassword');


});
