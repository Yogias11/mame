<?php

use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\SettingController;
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
    return view('test');
});

Route::prefix('master')->group(function() {
    // produk
    Route::get('produk', [ProdukController::class, 'index_produk'])->name('produk.index');
    Route::get('produk-detail/{id}', [ProdukController::class, 'index_produk_sub']);

    // kategori
    Route::get('kategori', [ProdukController::class, 'index_kategori']);
});

Route::prefix('setting')->group(function() {
    Route::get('menu', [SettingController::class, 'index_menu'])->name('menu.index');
    Route::post('menu-store', [SettingController::class, 'store_menu'])->name('menu.store');
    Route::post('menu-get', [SettingController::class, 'get_menu'])->name('menu.get');
    Route::delete('menu-delete/{id}', [SettingController::class, 'delete_menu'])->name('menu.delete');

    Route::get('submenu/{id}', [SettingController::class, 'index_submenu'])->name('submenu.index');

    Route::get('roles/', [SettingController::class, 'index_role'])->name('role.index');
});