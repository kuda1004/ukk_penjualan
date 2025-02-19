<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailpenjualanController;
use App\Http\Controllers\Layout;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;

Route::get('/generate-pdf', [PdfController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/penjualan-pdf', [PdfController::class, 'penjualanPDF'])->name('penjualan-pdf');
Route::get('/idpenjualan-pdf{penjualanid}', [PdfController::class, 'idpenjualanPDF'])->name('idpenjualan-pdf');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [Layout::class, 'index'])->name('dashboard');
Route::resource('detailpenjualan', DetailpenjualanController::class)->middleware('auth');
Route::resource('penjualan', PenjualanController::class)->middleware('auth');
Route::resource('produk', ProdukController::class)->middleware('auth');
Route::resource('pelanggan', PelangganController::class)->middleware('auth');

Route::get('/dashboard', [Layout::class, 'index'])->middleware('auth');


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
    return view('auth/login');
});
