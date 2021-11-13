<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DataFasilitasController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataSiswaController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [Controller::class, 'index']);

    //Data Sekolah
    Route::get('/dataSekolah/getData/{id}', [DataSekolahController::class, 'getData']);
    Route::get('/dataSekolah', [DataSekolahController::class, 'index']);
    Route::post('/dataSekolah/store', [DataSekolahController::class, 'store']);
    Route::post('/dataSekolah/update/{id}', [DataSekolahController::class, 'update']);
    Route::get('/dataSekolah/delete/{id}', [DataSekolahController::class, 'delete']);

    //data fasilitas
    Route::get('/dataFasilitas/getData/{id}', [DataFasilitasController::class, 'getData']);
    Route::get('/dataFasilitas', [DataFasilitasController::class, 'index']);
    Route::post('/dataFasilitas/store', [DataFasilitasController::class, 'store']);
    Route::post('/dataFasilitas/update/{id}', [DataFasilitasController::class, 'update']);
    Route::get('/dataFasilitas/delete/{id}', [DataFasilitasController::class, 'delete']);

    //data guru
    Route::get('/dataGuru/getData/{id}', [DataGuruController::class, 'getData']);
    Route::get('/dataGuru', [DataGuruController::class, 'index']);
    Route::post('/dataGuru/store', [DataGuruController::class, 'store']);
    Route::post('/dataGuru/update/{id}', [DataGuruController::class, 'update']);
    Route::get('/dataGuru/delete/{id}', [DataGuruController::class, 'delete']);

    //data guru
    Route::get('/dataSiswa/getData/{id}', [DataSiswaController::class, 'getData']);
    Route::get('/dataSiswa', [DataSiswaController::class, 'index']);
    Route::post('/dataSiswa/store', [DataSiswaController::class, 'store']);
    Route::post('/dataSiswa/update/{id}', [DataSiswaController::class, 'update']);
    Route::get('/dataSiswa/delete/{id}', [DataSiswaController::class, 'delete']);
});
require __DIR__.'/auth.php';
