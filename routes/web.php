<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PelangganAuthController;
use App\Http\Controllers\PaketWifiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PelangganTagihanController;
use App\Http\Controllers\PembayaranPelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KomplainAdminController;
use App\Http\Controllers\KomplainPelangganController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ExportPembayaranController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KeuanganExportController;

Route::get('/', function () {
    return view('pelanggan.login');
});
// Route Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');


    // Paket WiFi (Admin)
    Route::get('/admin/paket_wifi', [PaketWifiController::class, 'index'])->name('admin.paket_wifi');
    Route::get('/admin/paket_wifi/create', [PaketWifiController::class, 'create'])->name('admin.paket_wifi.create');
    Route::get('/admin/paket_wifi/{id}', [PaketWifiController::class, 'show'])->name('admin.paket_wifi.show');
    Route::post('/admin/paket_wifi', [PaketWifiController::class, 'store'])->name('admin.paket_wifi.store');
    Route::get('/admin/paket_wifi/{id}/edit', [PaketWifiController::class, 'edit'])->name('admin.paket_wifi.edit');
    Route::put('/admin/paket_wifi/{id}', [PaketWifiController::class, 'update'])->name('admin.paket_wifi.update');
    Route::delete('/admin/paket_wifi/{id}', [PaketWifiController::class, 'destroy'])->name('admin.paket_wifi.destroy');

    // Tagihan (Admin)
    Route::get('/admin/tagihan', [TagihanController::class, 'index'])->name('admin.tagihan');
    Route::get('/admin/tagihan/create', [TagihanController::class, 'create'])->name('admin.tagihan.create');
    Route::post('/admin/tagihan', [TagihanController::class, 'store'])->name('admin.tagihan.store');
    Route::get('/admin/tagihan/{id}', [TagihanController::class, 'show'])->name('admin.tagihan.show');
    Route::get('/admin/tagihan/{id}/edit', [TagihanController::class, 'edit'])->name('admin.tagihan.edit');
    Route::put('/admin/tagihan/{id}', [TagihanController::class, 'update'])->name('admin.tagihan.update');
    Route::delete('/admin/tagihan/{id}', [TagihanController::class, 'destroy'])->name('admin.tagihan.destroy');
    Route::put('/admin/tagihan/{id}/bayar', [TagihanController::class, 'bayar'])->name('admin.tagihan.bayar');
    Route::post('/admin/tagihan/generate', [TagihanController::class, 'generate'])->name('admin.tagihan.generate');
    Route::get('/admin/tagihan/pembayaran', [TagihanController::class, 'pembayaran'])->name('admin.tagihan.pembayaran');

    // Pelanggan (Admin)
    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('/admin/pelanggan/create', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
    Route::get('/admin/pelanggan/{id}', [PelangganController::class, 'show'])->name('admin.pelanggan.show');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
    Route::get('/admin/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('admin.pelanggan.edit');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');

    // Pembayaran (Admin)
    Route::get('/admin/tagihan/{id}/pembayaran', [PembayaranController::class, 'formPembayaran'])->name('admin.tagihan.pembayaran.form');
    Route::post('/admin/tagihan/{id}/pembayaran', [PembayaranController::class, 'uploadPembayaran'])->name('admin.tagihan.pembayaran');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran');
    
    // Komplain (Admin)
    Route::get('/admin/komplain', [KomplainAdminController::class, 'index'])->name('admin.komplain.index');
    Route::get('/admin/komplain/{id}', [KomplainAdminController::class, 'show'])->name('admin.komplain.show');
    Route::get('/admin/komplain/{id}/balas', [KomplainAdminController::class, 'formBalas'])->name('admin.komplain.balas.form');
    Route::post('/admin/komplain/{id}/balas', [KomplainAdminController::class, 'kirimBalasan'])->name('admin.komplain.balas.kirim');

    // Aset (Admin)
    Route::get('/admin/aset', [AsetController::class, 'index'])->name('admin.aset');
    Route::get('/admin/aset/create', [AsetController::class, 'create'])->name('admin.aset.create');
    Route::post('/admin/aset', [AsetController::class, 'store'])->name('admin.aset.store');
    Route::get('/admin/aset/{id}', [AsetController::class, 'show'])->name('admin.aset.show');
    Route::get('/admin/aset/{id}/edit', [AsetController::class, 'edit'])->name('admin.aset.edit');
    Route::put('/admin/aset/{id}', [AsetController::class, 'update'])->name('admin.aset.update');
    Route::delete('/admin/aset/{id}', [AsetController::class, 'destroy'])->name('admin.aset.destroy');

    // Export(Admin)
    Route::get('/admin/pembayaran/export', [ExportPembayaranController::class, 'exportExcel'])->name('pembayaran.export');
    Route::get('/admin/keuangan/export', [KeuanganExportController::class, 'export'])->name('admin.keuangan.export');

    
    Route::prefix('admin/keuangan')->name('admin.keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('index');

        // Pemasukan
        Route::get('/pemasukan/create', [KeuanganController::class, 'createPemasukan'])->name('createPemasukan');
        Route::post('/pemasukan/store', [KeuanganController::class, 'storePemasukan'])->name('storePemasukan');
        Route::get('/pemasukan/edit/{id}', [KeuanganController::class, 'editPemasukan'])->name('editPemasukan');
        Route::put('/pemasukan/update/{id}', [KeuanganController::class, 'updatePemasukan'])->name('updatePemasukan');
        Route::delete('/pemasukan/destroy/{id}', [KeuanganController::class, 'destroyPemasukan'])->name('destroyPemasukan');

        // Pengeluaran
        Route::get('/pengeluaran/create', [KeuanganController::class, 'createPengeluaran'])->name('createPengeluaran');
        Route::post('/pengeluaran/store', [KeuanganController::class, 'storePengeluaran'])->name('storePengeluaran');
        Route::get('/pengeluaran/edit/{id}', [KeuanganController::class, 'editPengeluaran'])->name('editPengeluaran');
        Route::put('/pengeluaran/update/{id}', [KeuanganController::class, 'updatePengeluaran'])->name('updatePengeluaran');
        Route::delete('/pengeluaran/destroy/{id}', [KeuanganController::class, 'destroyPengeluaran'])->name('destroyPengeluaran');
    });






// Route pelanggan
Route::get('/pelanggan/login', [PelangganAuthController::class, 'showLoginForm'])->name('pelanggan.login');
Route::post('/pelanggan/login', [PelangganAuthController::class, 'login']);
Route::post('pelanggan/logout', [PelangganAuthController::class, 'logout'])->name('pelanggan.logout');
    
    // Tagihan (Pelanggan)
    Route::get('/pelanggan/dashboard', [PelangganTagihanController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/pelanggan/pembayaran/{id}', [PembayaranPelangganController::class, 'formPembayaran'])->name('pelanggan.pembayaran.form');
    Route::post('/pelanggan/pembayaran/{id}', [PembayaranPelangganController::class, 'prosesPembayaran'])->name('pelanggan.pembayaran.proses');

    // Komplain (Pelanggan)
    Route::get('/pelanggan/komplain', [KomplainPelangganController::class, 'index'])->name('pelanggan.komplain.index');
    Route::get('/pelanggan/komplain/create', [KomplainPelangganController::class, 'create'])->name('pelanggan.komplain.create');
    Route::post('/pelanggan/komplain', [KomplainPelangganController::class, 'store'])->name('pelanggan.komplain.store');