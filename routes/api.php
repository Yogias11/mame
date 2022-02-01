<?php

use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\API\Master;
use App\Http\Controllers\API\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('master')->group(function() {
    Route::post('kategori', [Master::class, 'get_kelompok_produk']);
    Route::post('jenis', [Master::class, 'get_jenis_kelompok']);

    Route::prefix('setting')->group(function() {
        Route::post('role', [SettingController::class, 'get_data_role']);
        Route::post('create-role', [SettingController::class, 'create_data_role'])->name('role.store');
        Route::post('show-role', [SettingController::class, 'show_data_role']);
        Route::delete('delete-role', [SettingController::class, 'delete_data_role'])->name('role.delete');
    });
});


Route::prefix('v1')->group(function() {
    Route::post('produk', [Produk::class, 'get_data_produk']);
    Route::post('create-produk', [Produk::class, 'create_data_produk']);
    Route::post('show-produk', [Produk::class, 'show_data_produk']);
    Route::post('detail-produk', [Produk::class, 'detail_data_produk']);
    Route::delete('delete-produk', [Produk::class, 'delete_data_produk']);

    Route::post('show-produk/sub', [Produk::class, 'show_data_produk_sub']);
    Route::post('create-subproduk', [Produk::class, 'create_data_produk_sub']);
    Route::delete('delete-subproduk', [Produk::class, 'delete_data_produk_sub']);
    
    Route::post('kategori', [Produk::class, 'get_data_kategori']);
    Route::post('create-kategori', [Produk::class, 'create_data_kategori']);
    Route::post('show-kategori', [Produk::class, 'show_data_kategori']);
    Route::delete('delete-kategori', [Produk::class, 'delete_data_kategori']);
});