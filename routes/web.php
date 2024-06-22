<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TenderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::resource('tender', TenderController::class);

    Route::resource('penawaran', PenawaranController::class)->except("show");
    Route::get('penawaran/active', [PenawaranController::class, 'indexAktif']);
    Route::get('penawaran/selesai', [PenawaranController::class, 'indexSelesai']);

    Route::resource('stok', StokController::class);
    // Route::get('scheduler', [TenderController::class, 'scheduler']);
});

Route::get('penawaran/{id}', [PenawaranController::class, 'show']);

Route::get('tender-public', [TenderController::class, 'welcome']);
Route::get('tender-public/list', [TenderController::class, 'public']);
Route::get('tender-public/{id}', [TenderController::class, 'publicShow']);
Route::post('tender-public/{id}', [PenawaranController::class, 'publicStore']);
Route::get('tender-public/{id}/success', [TenderController::class, 'publicSuccess']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
