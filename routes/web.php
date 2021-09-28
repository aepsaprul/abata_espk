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
    // menu
    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create/menu_sub', [MenuController::class, 'createMenuSub'])->name('menu.create.menu_sub');
    Route::get('menu/create/menu_tombol', [MenuController::class, 'createMenuTombol'])->name('menu.create.menu_tombol');
    Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::post('menu/edit/menu_utama', [MenuController::class, 'editMenuUtama'])->name('menu.edit.menu_utama');
    Route::post('menu/edit/menu_sub', [MenuController::class, 'editMenuSub'])->name('menu.edit.menu_sub');
    Route::post('menu/update', [MenuController::class, 'update'])->name('menu.update');
    Route::post('menu/delete/btn', [MenuController::class, 'deleteBtn'])->name('menu.delete.btn');
    Route::post('menu/delete', [MenuController::class, 'delete'])->name('menu.delete');

    // karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/{id}/akses', [KaryawanController::class, 'akses'])->name('karyawan.akses');

    // navigasi
    Route::get('navigasi', [NavController::class, 'index'])->name('navigasi.index');
    Route::get('navigasi/create', [NavController::class, 'create'])->name('navigasi.create');
    Route::post('navigasi/store', [NavController::class, 'store'])->name('navigasi.store');
    Route::get('navigasi/{id}/edit', [NavController::class, 'edit'])->name('navigasi.edit');
    Route::put('navigasi/{id}/update', [NavController::class, 'update'])->name('navigasi.update');
    Route::get('navigasi/{id}/delete_btn', [NavController::class, 'deleteBtn'])->name('navigasi.delete_btn');
    Route::get('navigasi/{id}/delete', [NavController::class, 'delete'])->name('navigasi.delete');

    // data primer pelanggan
    Route::resource('pelanggan', PelangganController::class);
    Route::get('pelanggan/{id}/delete/btn', [PelangganController::class, 'deleteBtn'])->name('pelanggan.delete.btn');
    Route::get('pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');

    // data primer jenis pekerjaan
    Route::resource('jenis_pekerjaan', JenisPekerjaanController::class);
    Route::get('jenis_pekerjaan/{id}/edit_jenis', [JenisPekerjaanController::class, 'editJenis'])->name('jenis_pekerjaan.edit.jenis');
    Route::post('jenis_pekerjaan/delete/btn', [JenisPekerjaanController::class, 'deleteBtn'])->name('jenis_pekerjaan.delete.btn');
    Route::post('jenis_pekerjaan/delete', [JenisPekerjaanController::class, 'delete'])->name('jenis_pekerjaan.delete');

    // data pekerjaan
        // pesanan
    Route::resource('pekerjaan', PekerjaanController::class);
    Route::get('pekerjaan/{file}/download/{nama_pesanan}', [PekerjaanController::class, 'download'])->name('pekerjaan.download');
    Route::post('pekerjaan/publish', [PekerjaanController::class, 'publish'])->name('pekerjaan.publish');
    Route::post('pekerjaan/publish_store', [PekerjaanController::class, 'publishStore'])->name('pekerjaan.publish_store');

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
