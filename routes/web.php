<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [ItemController::class, 'showItem']);
    Route::get('/pesan/{id}', [PesanController::class, 'index']);
});

require __DIR__.'/auth.php';


Route::get('/item', [ItemController::class, 'showitem']);
Route::get('/pesan/{id}', [PesanController::class, 'index']);

Route::post('/pesan/{id}', [PesanController::class, 'pesan']);

Route::get('/checkout', [PesanController::class, 'checkout']);


Route::get('/invoice', [PesanController::class, 'invoice']);

Route::delete('/checkout/{id}', [PesanController::class, 'delete']);
