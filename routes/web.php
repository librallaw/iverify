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
    return view('verification.premium_test2');
});

Route::get('/test/print',"\App\Http\Controllers\PdfController@printTest" );

Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('doLogin');
Route::get('/login',[\App\Http\Controllers\AuthController::class,'showLogin'])->name('login');

Route::get('/register',[\App\Http\Controllers\AuthController::class,'showRegister'])->name('showRegister');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'doRegister'])->name('doRegister');

Route::group(['middleware'=>'auth'], function () {

    Route::post('/search', '\App\Http\Controllers\SearchController@search')->name("search");


    Route::get('/organisation/create', [\App\Http\Controllers\OrganisationController::class,'showCreateOrganisation'])->name("showCreateOrganisation");
    Route::post('/organisation/create', '\App\Http\Controllers\OrganisationController@doCreateOrganisation')->name('doCreateOrganisation');
    Route::get('/organisation/profile/{orgid}', '\App\Http\Controllers\OrganisationController@showOrganisationProfile')->name('showOrganisationProfile');

    Route::get('/organisation/delete/{orgid}', '\App\Http\Controllers\OrganisationController@deleteOrganisation')->name('deleteOrganisation');

    Route::post('/organisation/wallet/credit', '\App\Http\Controllers\OrganisationController@doCreditWallet')->name('doCreditWalletOrg');
    Route::post('/organisation/wallet/withdraw', '\App\Http\Controllers\OrganisationController@doWithdrawWallet')->name('doWithdrawWalletOrg');

    Route::post('/organisation/profile/edit', '\App\Http\Controllers\OrganisationController@doEditOrganisation')->name('doEditOrganisation');
    Route::get('/organisation/all', '\App\Http\Controllers\OrganisationController@showAllOrganisations')->name('showAllOrganisations');
    Route::get('/organisation/active', '\App\Http\Controllers\OrganisationController@showActiveOrganisations')->name('showActiveOrganisations');
    Route::get('/organisation/inactive', '\App\Http\Controllers\OrganisationController@showInactiveOrganisations')->name('showInactiveOrganisations');
    Route::get('/organisation/activate/{orgid}', '\App\Http\Controllers\OrganisationController@ActivateOrganisation')->name('ActivateOrganisationUser');

    Route::post('/organisation/wallet/show', '\App\Http\Controllers\PaymentController@getLink')->name('getLink');
    Route::get('/organisation/transaction/verify', '\App\Http\Controllers\PaymentController@verifyTransaction')->name('verifyTransaction');

    Route::get('/organisation/wallet/show', '\App\Http\Controllers\PaymentController@loadPaymentScreen')->name('loadPaymentScreen');
    Route::get('/organisation/wallet/success', '\App\Http\Controllers\PaymentController@verifyPaymentRef')->name('verifyPaymentRef');




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
Route::get("/topup/logs",[\App\Http\Controllers\VerificationController::class,'TopLog']) -> name("TopLog");
Route::get("/admin/topup/logs/{id}",[\App\Http\Controllers\VerificationController::class,'ShowTopLog']) -> name("ShowTopLog");
Route::get("/admin/sales/",[\App\Http\Controllers\VerificationController::class,'sales']) -> name("sales");

Route::post('/pdf/slip', '\App\Http\Controllers\PdfController@printSlip')->name("printSlip");
Route::post('/pdf/data', '\App\Http\Controllers\PdfController@downloadData')->name("downloadData");
Route::post('/pdf/premium', '\App\Http\Controllers\PdfController@printPremiumSlip')->name("printPremiumSlip");

Route::get('/settings',[\App\Http\Controllers\AuthController::class,'changePassword'])->name('changePassword');
Route::post('/settings',[\App\Http\Controllers\AuthController::class,'doChangePassword'])->name('doChangePassword');


});
