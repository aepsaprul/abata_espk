<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\JenisPekerjaanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\ProsesPekerjaanController;

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
        Route::get('admin/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('admin/menu/create/menu_sub', [MenuController::class, 'createMenuSub'])->name('menu.create.menu_sub');
        Route::get('admin/menu/create/menu_tombol', [MenuController::class, 'createMenuTombol'])->name('menu.create.menu_tombol');
        Route::post('admin/menu/store', [MenuController::class, 'store'])->name('menu.store');
        Route::post('admin/menu/edit/menu_utama', [MenuController::class, 'editMenuUtama'])->name('menu.edit.menu_utama');
        Route::post('admin/menu/edit/menu_sub', [MenuController::class, 'editMenuSub'])->name('menu.edit.menu_sub');
        Route::post('admin/menu/update', [MenuController::class, 'update'])->name('menu.update');
        Route::post('admin/menu/delete/btn', [MenuController::class, 'deleteBtn'])->name('menu.delete.btn');
        Route::post('admin/menu/delete', [MenuController::class, 'delete'])->name('menu.delete');

        // karyawan
        Route::get('admin/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('admin/karyawan/{id}/akses', [KaryawanController::class, 'akses'])->name('karyawan.akses');
        Route::put('admin/karyawan/{id}/akses_simpan', [KaryawanController::class, 'aksesSimpan'])->name('karyawan.akses_simpan');

    // navigasi
    Route::get('navigasi', [NavController::class, 'index'])->name('navigasi.index');
    Route::get('navigasi/create', [NavController::class, 'create'])->name('navigasi.create');
    Route::post('navigasi/store', [NavController::class, 'store'])->name('navigasi.store');
    Route::get('navigasi/{id}/edit', [NavController::class, 'edit'])->name('navigasi.edit');
    Route::put('navigasi/{id}/update', [NavController::class, 'update'])->name('navigasi.update');
    Route::get('navigasi/{id}/delete_btn', [NavController::class, 'deleteBtn'])->name('navigasi.delete_btn');
    Route::get('navigasi/{id}/delete', [NavController::class, 'delete'])->name('navigasi.delete');

    // data primer
        // pelanggan
        Route::resource('data_primer/pelanggan', PelangganController::class);
        Route::get('data_primer/pelanggan/{id}/delete/btn', [PelangganController::class, 'deleteBtn'])->name('pelanggan.delete.btn');
        Route::get('data_primer/pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');

        // jenis pekerjaan
        Route::resource('data_primer/jenis_pekerjaan', JenisPekerjaanController::class);
        Route::get('data_primer/jenis_pekerjaan/{id}/edit_jenis', [JenisPekerjaanController::class, 'editJenis'])->name('jenis_pekerjaan.edit.jenis');
        Route::post('data_primer/jenis_pekerjaan/delete/btn', [JenisPekerjaanController::class, 'deleteBtn'])->name('jenis_pekerjaan.delete.btn');
        Route::post('data_primer/jenis_pekerjaan/delete', [JenisPekerjaanController::class, 'delete'])->name('jenis_pekerjaan.delete');

    // data pekerjaan
        // pesanan
        Route::resource('data_pekerjaan/pekerjaan', PekerjaanController::class);
        Route::get('data_pekerjaan/pekerjaan/{id}/show', [PekerjaanController::class, 'show'])->name('pekerjaan.show');
        Route::get('data_pekerjaan/pekerjaan/{file}/download', [PekerjaanController::class, 'download'])->name('pekerjaan.download');
        Route::post('data_pekerjaan/pekerjaan/publish', [PekerjaanController::class, 'publish'])->name('pekerjaan.publish');
        Route::post('data_pekerjaan/pekerjaan/publish_store', [PekerjaanController::class, 'publishStore'])->name('pekerjaan.publish_store');

        // proses pekerjaan
        Route::get('proses_pekerjaan', [ProsesPekerjaanController::class, 'index'])->name('proses_pekerjaan.index');
        Route::get('proses_pekerjaan/{id}/edit_status', [ProsesPekerjaanController::class, 'editStatus'])->name('proses_pekerjaan.edit_status');
        Route::post('proses_pekerjaan/update_status', [ProsesPekerjaanController::class, 'updateStatus'])->name('proses_pekerjaan.update_status');
        Route::get('proses_pekerjaan/{id}/show', [ProsesPekerjaanController::class, 'show'])->name('proses_pekerjaan.show');
        Route::get('proses_pekerjaan/{id}/print', [ProsesPekerjaanController::class, 'print'])->name('proses_pekerjaan.print');

    // laporan
    Route::get('laporan/pekerjaan', [LaporanController::class, 'indexPekerjaan'])->name('laporan.index_pekerjaan');
    Route::get('laporan/get_data_pekerjaan', [LaporanController::class, 'getDataPekerjaan'])->name('laporan.get_data_pekerjaan');

});
