<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify' => true]);


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get("/getkabupaten/{id}", "Auth\RegisterController@kabupaten_baru");
Route::get("/getkecamatan/{id}", "Auth\RegisterController@kecamatan_baru");
Route::get("/getdesa/{id}", "Auth\RegisterController@desa_baru");


Route::get('account/password', 'Account\PasswordController@edit')->name('password.edit');
Route::patch('account/password', 'Account\PasswordController@update')->name('password.edit');

Route::group(
    ['middleware' => 'auth'],
    function () {
        // MODUL ADMIN MARKETPLACE ------------------------------------------------------------ ADM. Marketplace
        Route::prefix('AdminMarketplace')
            ->namespace('AdminMarketplace')
            ->middleware(['admin_marketplace', 'verified'])
            ->group(function () {
                Route::get('/', 'DashboardadminController@index')
                    ->name('dashboardmarketplace');
                Route::get('/faq', 'DashboardadminController@faq')
                    ->name('faq');
                Route::put('/faqupdate/{id}', 'DashboardadminController@update')
                    ->name('faq-update');
                Route::delete('/faqdestroy/{id}', 'DashboardadminController@destroy')
                    ->name('faq-destroy');
                Route::get('/transaksi', 'TransaksiController@index')
                    ->name('transaksi-marketplace');
                Route::put('/transaksiupdate/{id}', 'TransaksiController@update')
                    ->name('transaksi-marketplace-update');
                Route::get('/transaksi/keuangan', 'KeuanganController@index')
                    ->name('keuangan');
                Route::delete('/keuangandestroy/{id}', 'KeuanganController@destroy')
                    ->name('keuangan-destroy');
                Route::post('/tariksaldo', 'KeuanganController@create')
                    ->name('tarik-saldo');
                Route::get('/sparepart', 'SparepartMarketplaceController@index')
                    ->name('sparepart-marketplace');
                Route::put('/sparepartupdate/{id}', 'SparepartMarketplaceController@update')
                    ->name('sparepart-marketplace-update');
            });

        // PENJUALAN ONLINE ---------------------------------------------------------------------- Penjualan Online
        Route::prefix('AdminMarketplace/Penjualan')
            ->namespace('AdminMarketplace\Penjualan')
            ->middleware(['admin_marketplace', 'verified'])
            ->group(function () {
                Route::get('/', 'PenjualanController@index')
                    ->name('Penjualan-Online');
            });
    }
);
