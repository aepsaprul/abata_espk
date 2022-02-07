<?php

use App\Http\Controllers\CabangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\JenisPekerjaanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PesananPublishController;
use App\Http\Controllers\ProsesPekerjaanController;
use App\Http\Controllers\UserController;

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

Route::get('/', function() {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // admin
        // menu
        Route::get('admin/navigasi', [MenuController::class, 'index'])->name('navigasi.index');
            // navigasi main
            Route::post('admin/navigasi/main_store', [MenuController::class, 'mainStore'])->name('navigasi.main_store');
            Route::get('admin/navigasi/{id}/main_edit', [MenuController::class, 'mainEdit'])->name('navigasi.main_edit');
            Route::post('admin/navigasi/main_update', [MenuController::class, 'mainUpdate'])->name('navigasi.main_update');
            Route::get('admin/navigasi/{id}/main_delete_btn', [MenuController::class, 'mainDeleteBtn'])->name('navigasi.main_delete_btn');
            Route::post('admin/navigasi/main_delete', [MenuController::class, 'mainDelete'])->name('navigasi.main_delete');

            // navigasi sub
            Route::get('admin/navigasi/sub_create', [MenuController::class, 'subCreate'])->name('navigasi.sub_create');
            Route::post('admin/navigasi/sub_store', [MenuController::class, 'subStore'])->name('navigasi.sub_store');
            Route::get('admin/navigasi/{id}/sub_edit', [MenuController::class, 'subEdit'])->name('navigasi.sub_edit');
            Route::post('admin/navigasi/sub_update', [MenuController::class, 'subUpdate'])->name('navigasi.sub_update');
            Route::get('admin/navigasi/{id}/sub_delete_btn', [MenuController::class, 'subDeleteBtn'])->name('navigasi.sub_delete_btn');
            Route::post('admin/navigasi/sub_delete', [MenuController::class, 'subDelete'])->name('navigasi.sub_delete');

        // user
        Route::get('admin/user', [UserController::class, 'index'])->name('user.index');
        Route::get('admin/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('admin/user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('admin/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('admin/user/{id}/access', [UserController::class, 'access'])->name('user.access');
        Route::put('admin/user/{id}/access_save', [UserController::class, 'accessSave'])->name('user.access_save');
        Route::post('admin/user/sync', [UserController::class, 'sync'])->name('user.sync');

        // cabang
        Route::get('admin/cabang', [CabangController::class, 'index'])->name('cabang.index');
        Route::get('admin/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
        Route::post('admin/cabang/store', [CabangController::class, 'store'])->name('cabang.store');
        Route::get('admin/cabang/{id}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
        Route::put('admin/cabang/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
        Route::post('admin/cabang/delete', [CabangController::class, 'delete'])->name('cabang.delete');

    // data primer
        // pelanggan
        Route::resource('data_primer/pelanggan', PelangganController::class);
        Route::post('data_primer/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::get('data_primer/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
        Route::put('data_primer/pelanggan/{id}/update', [PelangganController::class, 'update'])->name('pelanggan.update');
        Route::get('data_primer/pelanggan/{id}/delete_btn', [PelangganController::class, 'deleteBtn'])->name('pelanggan.delete_btn');
        Route::post('data_primer/pelanggan/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');

        // jenis pekerjaan
        Route::resource('data_primer/jenis_pekerjaan', JenisPekerjaanController::class);
        Route::get('data_primer/jenis_pekerjaan/{id}/edit_jenis', [JenisPekerjaanController::class, 'editJenis'])->name('jenis_pekerjaan.edit.jenis');
        Route::post('data_primer/jenis_pekerjaan/delete/btn', [JenisPekerjaanController::class, 'deleteBtn'])->name('jenis_pekerjaan.delete.btn');
        Route::post('data_primer/jenis_pekerjaan/delete', [JenisPekerjaanController::class, 'delete'])->name('jenis_pekerjaan.delete');

    // data pekerjaan
        // pesanan
        Route::resource('data_pekerjaan/pekerjaan', PekerjaanController::class);
        Route::get('data_pekerjaan/pekerjaan/{id}/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
        Route::get('data_pekerjaan/pekerjaan/{id}/show', [PekerjaanController::class, 'show'])->name('pekerjaan.show');
        Route::get('data_pekerjaan/pekerjaan/{file}/download', [PekerjaanController::class, 'download'])->name('pekerjaan.download');
        Route::post('data_pekerjaan/pekerjaan/publish', [PekerjaanController::class, 'publish'])->name('pekerjaan.publish');
        Route::post('data_pekerjaan/pekerjaan/publish_store', [PekerjaanController::class, 'publishStore'])->name('pekerjaan.publish_store');

        // pesanan publish
        Route::get('data_pekerjaan/pesanan_publish', [PesananPublishController::class, 'index'])->name('pesanan_publish.index');

        // proses pekerjaan
        Route::get('data_pekerjaan/proses_pekerjaan', [ProsesPekerjaanController::class, 'index'])->name('proses_pekerjaan.index');
        Route::get('data_pekerjaan/proses_pekerjaan/{id}/edit_status', [ProsesPekerjaanController::class, 'editStatus'])->name('proses_pekerjaan.edit_status');
        Route::post('data_pekerjaan/proses_pekerjaan/update_status', [ProsesPekerjaanController::class, 'updateStatus'])->name('proses_pekerjaan.update_status');
        Route::get('data_pekerjaan/proses_pekerjaan/{id}/show', [ProsesPekerjaanController::class, 'show'])->name('proses_pekerjaan.show');
        Route::get('data_pekerjaan/proses_pekerjaan/{id}/print', [ProsesPekerjaanController::class, 'print'])->name('proses_pekerjaan.print');

    // laporan
    Route::get('laporan/pekerjaan', [LaporanController::class, 'indexPekerjaan'])->name('laporan.index_pekerjaan');
    Route::get('laporan/get_data_pekerjaan', [LaporanController::class, 'getDataPekerjaan'])->name('laporan.get_data_pekerjaan');

});
