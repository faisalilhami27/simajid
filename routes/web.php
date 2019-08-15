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
    Route::get('/', 'PengurusController@index')->name('pengurus');
    Route::post('/json', 'PengurusController@datatable');
    Route::post('/get', 'PengurusController@edit');
    Route::post('/insert', 'PengurusController@store');
    Route::post('/cekEmail', 'PengurusController@cekEmail');
    Route::post('/cekNoHp', 'PengurusController@cekNoHp');
    Route::put('/update', 'PengurusController@update');
    Route::delete('/delete', 'PengurusController@destroy');
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

// modul konfigurasi web
Route::group(['prefix' => 'konfigurasi', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'KonfigurasiController@index')->name('konfigurasi');
    Route::post('/update', 'KonfigurasiController@update');
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

// modul pengurus
Route::group(['prefix' => 'jadwal', 'middleware' => 'auth:pengurus'], function () {
    Route::get('/', 'UserController@index')->name('jadwal');
    Route::post('/json', 'UserController@datatable');
    Route::get('/cekUsername', 'UserController@cekUsername');
    Route::get('/cekEmail', 'UserController@cekEmail');
    Route::get('/cekNoHp', 'UserController@cekNoHp');
    Route::get('/getUserById', 'UserController@edit');
    Route::post('/insert', 'UserController@store');
    Route::put('/resetpassword', 'UserController@resetPassword');
    Route::put('/update', 'UserController@update');
    Route::delete('/delete', 'UserController@destroy');
});
