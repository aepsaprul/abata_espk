<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create/menu_sub', [MenuController::class, 'createMenuSub'])->name('menu.create.menu_sub');
    Route::get('menu/create/menu_tombol', [MenuController::class, 'createMenuTombol'])->name('menu.create.menu_tombol');
    Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::post('menu/edit/menu_utama', [MenuController::class, 'editMenuUtama'])->name('menu.edit.menu_utama');
    Route::post('menu/edit/menu_sub', [MenuController::class, 'editMenuSub'])->name('menu.edit.menu_sub');
    Route::post('menu/update', [MenuController::class, 'update'])->name('menu.update');
    Route::post('menu/delete/btn', [MenuController::class, 'deleteBtn'])->name('menu.delete.btn');
    Route::post('menu/delete', [MenuController::class, 'delete'])->name('menu.delete');
});
