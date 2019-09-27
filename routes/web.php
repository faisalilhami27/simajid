<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/staff/login', 'Auth\LoginController@staffLogin')->name('staff.login');
Route::get('/', 'DashboardController@index')
    ->middleware('auth:pengurus')
    ->name("dashboard");
Route::get('/choose/roles', 'RoleController@chooseRole')
    ->middleware('auth:pengurus')
    ->name('role.pickList');
Route::post('/choose/role', 'RoleController@pickRole')
    ->middleware('auth:pengurus')
    ->name('role.pick');
Route::get('/chart', 'DashboardController@chartKeuangan')
    ->middleware('auth:pengurus')
    ->name('chart');

// modul profile
Route::group(['prefix' => 'profile', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::post('/update', 'ProfileController@update');
    Route::put('/changePassword', 'ProfileController@changePassword');
});

// modul kelola menu
Route::group(['prefix' => 'navigation', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'NavigationController@index')->name('navigation');
    Route::post('/json', 'NavigationController@datatable');
    Route::get('/getNavigation', 'NavigationController@getNavigation');
    Route::post('/get', 'NavigationController@edit');
    Route::post('/insert', 'NavigationController@store');
    Route::put('/update', 'NavigationController@update');
    Route::delete('/delete', 'NavigationController@destroy');
});

// modul pengurus
Route::group(['prefix' => 'pengurus', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/jabatan', 'PengurusController@getJabatan');
    Route::post('/get', 'PengurusController@edit');
    Route::post('/insert', 'PengurusController@store');
    Route::post('/cekEmail', 'PengurusController@cekEmail');
    Route::post('/cekNoHp', 'PengurusController@cekNoHp');
    Route::put('/update', 'PengurusController@update');
    Route::delete('/delete', 'PengurusController@destroy');

    Route::prefix('dkm')->group(function () {
        Route::get('/', 'PengurusController@index')->name('pengurus.dkm');
        Route::post('/json', 'PengurusController@datatable1');
    });

    Route::prefix('majelis')->group(function () {
        Route::get('/', 'PengurusController@majelisPage')->name('pengurus.majelis');
        Route::post('/json', 'PengurusController@datatable2');
    });

    Route::prefix('remaja')->group(function () {
        Route::get('/', 'PengurusController@remajaPage')->name('pengurus.remaja');
        Route::post('/json', 'PengurusController@datatable3');
    });
});

// modul role level
Route::group(['prefix' => 'role_level', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'RoleLevelController@index')->name('role_level');
    Route::post('/json', 'RoleLevelController@datatable');
    Route::post('/get', 'RoleLevelController@edit');
    Route::post('/insert', 'RoleLevelController@store');
    Route::put('/update', 'RoleLevelController@update');
    Route::delete('/delete', 'RoleLevelController@destroy');
});

// modul donatur
Route::group(['prefix' => 'donatur', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'DonaturController@index')->name('donatur');
    Route::post('/json', 'DonaturController@datatable');
    Route::post('/get', 'DonaturController@edit');
    Route::get('/jenis', 'DonaturController@getJenisDonatur');
    Route::post('/insert', 'DonaturController@store');
    Route::put('/update', 'DonaturController@update');
    Route::delete('/delete', 'DonaturController@destroy');
});

// modul user navigation
Route::group(['prefix' => 'akses', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'UserNavigationController@index')->name('akses');
    Route::post('/json', 'UserNavigationController@datatable');
    Route::get('/getLevel', 'UserNavigationController@getLevel');
    Route::get('/getNavigation', 'UserNavigationController@getNavigation');
    Route::post('/get', 'UserNavigationController@edit');
    Route::post('/insert', 'UserNavigationController@store');
    Route::put('/update', 'UserNavigationController@update');
    Route::delete('/delete', 'UserNavigationController@destroy');
});

// modul user pengurus
Route::group(['prefix' => 'user', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'UserPengurusController@index')->name('user');
    Route::post('/json', 'UserPengurusController@datatable');
    Route::post('/get', 'UserPengurusController@edit');
    Route::get('/getLevel', 'UserPengurusController@getLevel');
    Route::get('/getPengurus', 'UserPengurusController@getPengurus');
    Route::post('/insert', 'UserPengurusController@store');
    Route::put('/update', 'UserPengurusController@update');
    Route::post('/cekUsername', 'UserPengurusController@cekUsername');
    Route::put('/reset', 'UserPengurusController@resetPassword');
    Route::delete('/delete', 'UserPengurusController@destroy');
});

// modul jadwal sholat
Route::group(['prefix' => 'jadwal', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JadwalSholatController@index')->name('jadwal');
    Route::post('/json', 'JadwalSholatController@datatable');
    Route::post('/update', 'JadwalSholatController@update');
});

// modul jenis donatur
Route::group(['prefix' => 'jenis_donatur', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JenisDonaturController@index')->name('jenis_donatur');
    Route::post('/json', 'JenisDonaturController@datatable');
    Route::post('/get', 'JenisDonaturController@edit');
    Route::post('/insert', 'JenisDonaturController@store');
    Route::put('/update', 'JenisDonaturController@update');
    Route::delete('/delete', 'JenisDonaturController@destroy');
});

// modul jenis pengurus
Route::group(['prefix' => 'jenis_pengurus', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JenisPengurusController@index')->name('jenis_pengurus');
    Route::post('/json', 'JenisPengurusController@datatable');
    Route::post('/get', 'JenisPengurusController@edit');
    Route::post('/insert', 'JenisPengurusController@store');
    Route::put('/update', 'JenisPengurusController@update');
    Route::delete('/delete', 'JenisPengurusController@destroy');
});

// modul jenis pengeluaran
Route::group(['prefix' => 'jenis_pengeluaran', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JenisPengeluaranController@index')->name('jenis_pengeluaran');
    Route::post('/json', 'JenisPengeluaranController@datatable');
    Route::post('/get', 'JenisPengeluaranController@edit');
    Route::post('/insert', 'JenisPengeluaranController@store');
    Route::put('/update', 'JenisPengeluaranController@update');
    Route::delete('/delete', 'JenisPengeluaranController@destroy');
});

// modul jenis infaq
Route::group(['prefix' => 'jenis_infaq', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JenisInfaqController@index')->name('jenis_infaq');
    Route::post('/json', 'JenisInfaqController@datatable');
    Route::post('/get', 'JenisInfaqController@edit');
    Route::post('/insert', 'JenisInfaqController@store');
    Route::put('/update', 'JenisInfaqController@update');
    Route::delete('/delete', 'JenisInfaqController@destroy');
});

// modul pemasukan
Route::group(['prefix' => 'pemasukan', 'middleware' => 'auth:pengurus'], function () {
    Route::post('/get', 'PemasukanController@edit');
    Route::post('/insert', 'PemasukanController@store');
    Route::put('/update', 'PemasukanController@update');
    Route::delete('/delete', 'PemasukanController@destroy');

    Route::prefix('infaq')->group(function () {
        Route::get('/', 'PemasukanController@index')->name('pemasukan.infaq');
        Route::post('/json', 'PemasukanController@datatable');
        Route::post('/jenis', 'PemasukanController@getJenisInfaq');
    });

    Route::prefix('shodaqoh')->group(function () {
        Route::get('/', 'PemasukanController@shodaqohPage')->name('pemasukan.shodaqoh');
        Route::post('/json', 'PemasukanController@datatable2');
        Route::post('/donatur', 'PemasukanController@getDonatur');
    });
});

// modul pengeluaran
Route::group(['prefix' => 'pengeluaran', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'PengeluaranController@index')->name('pengeluaran');
    Route::post('/json', 'PengeluaranController@datatable');
    Route::post('/get', 'PengeluaranController@edit');
    Route::post('/jenis', 'PengeluaranController@getJenisPengeluaran');
    Route::post('/insert', 'PengeluaranController@store');
    Route::put('/update', 'PengeluaranController@update');
    Route::delete('/delete', 'PengeluaranController@destroy');
});

// modul jabatan
Route::group(['prefix' => 'jabatan', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'JabatanController@index')->name('jabatan');
    Route::post('/json', 'JabatanController@datatable');
    Route::post('/get', 'JabatanController@edit');
    Route::post('/insert', 'JabatanController@store');
    Route::put('/update', 'JabatanController@update');
    Route::delete('/delete', 'JabatanController@destroy');
});

// modul struktur organisasi
Route::group(['prefix' => 'struktur', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/get', 'StrukturOrganisasiController@edit')->name('struktur.edit');
    Route::get('/show', 'StrukturOrganisasiController@show')->name('struktur.show');
    Route::get('/showMajelisTaklim', 'StrukturOrganisasiController@showMajelisTaklim')->name('struktur.show_majelis');
    Route::get('/showRemajaMesjid', 'StrukturOrganisasiController@showRemajaMesjid')->name('struktur.show_remaja');
    Route::put('/update', 'StrukturOrganisasiController@update')->name('struktur.update');

    Route::prefix('dkm')->group(function () {
        Route::get('/', 'StrukturOrganisasiController@index')->name('struktur.dkm');
    });

    Route::prefix('majelis')->group(function () {
        Route::get('/', 'StrukturOrganisasiController@majelisTaklimPage')->name('struktur.majelis');
    });

    Route::prefix('remaja')->group(function () {
        Route::get('/', 'StrukturOrganisasiController@remajaMesjidPage')->name('struktur.remaja');
    });
});

// modul konfigurasi web
Route::group(['prefix' => 'konfigurasi', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'KonfigurasiController@index')->name('konfigurasi');
    Route::post('/update', 'KonfigurasiController@update');
});
