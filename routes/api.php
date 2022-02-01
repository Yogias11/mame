<?php

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
    // Route::prefix('produk')->group(function() {
    //     Route::post('delete', [])
    // });

});